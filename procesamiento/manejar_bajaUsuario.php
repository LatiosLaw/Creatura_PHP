<?php

ob_start();

require_once("../clases/usuario.php");
require_once("../clases/tipo.php");
require_once("../clases/creatura.php");

$controladorUsuario = new Usuario();
$controladorTipo = new Tipo();
$controladorCreatura = new Creatura();

session_start();

if (!isset($_SESSION['nickname'])) {
    header("Location: /Creatura_PHP/index.php?error=no_sesion");
    exit();
}

$nickname = $_SESSION['nickname'];

$fallo = false;
$mensaje_error = '';

// Listar tipos del usuario y eliminar todo lo relacionado
$tipos_del_usuario = $controladorTipo->listar_tipos_creador($nickname);

if ($tipos_del_usuario && mysqli_num_rows($tipos_del_usuario) > 0) {
    while ($tipo = mysqli_fetch_assoc($tipos_del_usuario)) {
        // Eliminar habilidades del tipo
        $habilidades = $controladorTipo->retornar_habilidades_tipo($tipo['id_tipo']);
        if (is_array($habilidades) && count($habilidades) > 0) {
            foreach ($habilidades as $habilidad) {
                if (isset($habilidad['id_habilidad'])) {
                    $res = $controladorCreatura->baja_habilidad($habilidad['id_habilidad']);
                    if (!$res) {
                        $fallo = true;
                        $mensaje_error = "Error al eliminar habilidad '{$habilidad['nombre_habilidad']}'";
                        break;  // Salir foreach habilidades
                    }
                }
            }
        }
        if ($fallo) break;  // Salir while tipos

        // Modificar criaturas que usan este tipo
        $criaturas_perjudicadas = $controladorTipo->retornar_creaturas_tipo($tipo['id_tipo']);
        if ($criaturas_perjudicadas && mysqli_num_rows($criaturas_perjudicadas) > 0) {
            while ($pobrecito = mysqli_fetch_assoc($criaturas_perjudicadas)) {
                if ($pobrecito['id_tipo1'] == $tipo['id_tipo']) {
                    $res = $controladorCreatura->modificar_creatura(
                        $pobrecito['id_creatura'], $pobrecito['nombre_creatura'], $pobrecito['id_tipo2'], 0,
                        $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'], $pobrecito['def'],
                        $pobrecito['spa'], $pobrecito['sdef'], $pobrecito['spe'], $pobrecito['creador'],
                        $pobrecito['imagen'], $pobrecito['publico']
                    );
                } else {
                    $res = $controladorCreatura->modificar_creatura(
                        $pobrecito['id_creatura'], $pobrecito['nombre_creatura'], $pobrecito['id_tipo1'], 0,
                        $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'], $pobrecito['def'],
                        $pobrecito['spa'], $pobrecito['sdef'], $pobrecito['spe'], $pobrecito['creador'],
                        $pobrecito['imagen'], $pobrecito['publico']
                    );
                }
                if (!$res) {
                    $fallo = true;
                    $mensaje_error = "Error al modificar criatura '{$pobrecito['nombre_creatura']}'";
                    break; // Salir while criaturas
                }
            }
        }
        if ($fallo) break; // Salir while tipos

        // Eliminar efectividades
        $res = $controladorTipo->eliminar_efectividades($tipo['id_tipo']);
        if (!$res) {
            $fallo = true;
            $mensaje_error = "Error al eliminar efectividades del tipo '{$tipo['nombre_tipo']}'";
            break;  // Salir while tipos
        }

        // Eliminar tipo
        $res = $controladorTipo->baja_tipo($tipo['id_tipo']);
        if (!$res) {
            $fallo = true;
            $mensaje_error = "Error al eliminar tipo '{$tipo['nombre_tipo']}'";
            break; // Salir while tipos
        }
    }
}

// Eliminar ratings
if (!$fallo) {
    $ratings = $controladorCreatura->listar_ratings_usuario($nickname);
    if ($ratings && mysqli_num_rows($ratings) > 0) {
        while ($rating = mysqli_fetch_assoc($ratings)) {
            if (isset($rating['id_rating'])) {
                $res = $controladorCreatura->baja_rating($rating['id_rating']);
                if (!$res) {
                    $fallo = true;
                    $mensaje_error = "Error al eliminar rating ID {$rating['id_rating']}";
                    break; // Salir while ratings
                }
            }
        }
    }
}

// Eliminar creaturas
if (!$fallo) {
    $creaturas = $controladorCreatura->listar_creaturas_ext(500, $nickname);
    if ($creaturas && mysqli_num_rows($creaturas) > 0) {
        while ($creatura = mysqli_fetch_assoc($creaturas)) {
            if (isset($creatura['id_creatura'])) {
                $res = $controladorCreatura->baja_creatura($creatura['id_creatura']);
                if (!$res) {
                    $fallo = true;
                    $mensaje_error = "Error al eliminar creatura '{$creatura['nombre_creatura']}'";
                    break; // Salir while creaturas
                }
            }
        }
    }
}

// Finalmente eliminar usuario
if (!$fallo) {
    $res = $controladorUsuario->baja_usuario($nickname);
    if (!$res) {
        $fallo = true;
        $mensaje_error = "Error al eliminar usuario '{$nickname}'";
    }
}

session_destroy();

if ($fallo) {
    header("Location: /Creatura_PHP/index.php?error=" . urlencode($mensaje_error));
} else {
    header("Location: /Creatura_PHP/index.php?success=eliminar_usuario_exitosa");
}
exit();

?>


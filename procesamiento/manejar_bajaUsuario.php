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

if (is_array($tipos_del_usuario) && count($tipos_del_usuario) > 0) {
    foreach ($tipos_del_usuario as $tipo) {

        /*-------------------------------------------------
         * 1) Eliminar habilidades del tipo
         *------------------------------------------------*/
        $habilidades = $controladorTipo->retornar_habilidades_tipo($tipo['id_tipo']);
        if (is_array($habilidades)) {
            foreach ($habilidades as $hab) {
                if (!empty($hab['id_habilidad'])) {
                    if (!$controladorCreatura->baja_habilidad($hab['id_habilidad'])) {
                        $fallo = true;
                        $mensaje_error = "Error al eliminar habilidad '{$hab['nombre_habilidad']}'";
                        break 2;          // sale del foreach tipos
                    }
                }
            }
        }

        /*-------------------------------------------------
         * 2) Modificar criaturas que usan este tipo
         *------------------------------------------------*/
        $criaturas = $controladorTipo->retornar_creaturas_tipo($tipo['id_tipo']);
        if (is_array($criaturas)) {
            foreach ($criaturas as $crea) {
                $nuevoTipo1 = ($crea['id_tipo1'] == $tipo['id_tipo'])
                              ? $crea['id_tipo2']
                              : $crea['id_tipo1'];

                $ok = $controladorCreatura->modificar_creatura(
                    $crea['id_creatura'], $crea['nombre_creatura'],
                    $nuevoTipo1, 0,                       // id_tipo2 pasa a 0
                    $crea['descripcion'], $crea['hp'], $crea['atk'], $crea['def'],
                    $crea['spa'], $crea['sdef'], $crea['spe'],
                    $crea['creador'], $crea['imagen'], $crea['publico']
                );

                if (!$ok) {
                    $fallo = true;
                    $mensaje_error = "Error al modificar criatura '{$crea['nombre_creatura']}'";
                    break 2;      // sale del foreach tipos
                }
            }
        }

        /*-------------------------------------------------
         * 3) Eliminar efectividades y el tipo en sí
         *------------------------------------------------*/
        if (!$controladorTipo->eliminar_efectividades($tipo['id_tipo'])) {
            $fallo = true;
            $mensaje_error = "Error al eliminar efectividades del tipo '{$tipo['nombre_tipo']}'";
            break;
        }

        if (!$controladorTipo->baja_tipo($tipo['id_tipo'])) {
            $fallo = true;
            $mensaje_error = "Error al eliminar tipo '{$tipo['nombre_tipo']}'";
            break;
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


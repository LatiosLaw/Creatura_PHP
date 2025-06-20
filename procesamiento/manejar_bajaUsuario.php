<?php

ob_start();

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

session_start();

if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
} else {
    exit("No hay sesión iniciada.");
}

// Listar tipos del usuario
$tipos_del_usuario = $controladorTipo->listar_tipos_creador($nickname);
if ($tipos_del_usuario && mysqli_num_rows($tipos_del_usuario) > 0) {
    while ($tipo = mysqli_fetch_assoc($tipos_del_usuario)) {
        echo "TIPO : " . $tipo['nombre_tipo'] . "<br>";
        // Obtener habilidades del tipo
        $habilidades = $controladorTipo->retornar_habilidades_tipo($tipo['id_tipo']);
        if (is_array($habilidades) && count($habilidades) > 0) {
            foreach ($habilidades as $habilidad) {
                if (isset($habilidad['id_habilidad'])) {
                    echo "Eliminando habilidad : " . $habilidad['nombre_habilidad'] . "<br>";
                    $controladorCreatura->baja_habilidad($habilidad['id_habilidad']);
                }
            }
        }

        $criaturas_perjudicadas = $controladorTipo->retornar_creaturas_tipo($tipo['id_tipo']);
        if ($criaturas_perjudicadas && mysqli_num_rows($criaturas_perjudicadas) > 0) {
    while ($pobrecito = mysqli_fetch_assoc($criaturas_perjudicadas)) {
        echo "Cambiando tipos de la creatura : " . $pobrecito['nombre_creatura'] . "<br>";
        if($pobrecito['id_tipo1'] == $tipo['id_tipo']){
$controladorCreatura->modificar_creatura($pobrecito['id_creatura'], $pobrecito['nombre_creatura'], $pobrecito['id_tipo2'], 0, $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'], $pobrecito['def'], $pobrecito['spa'], $pobrecito['sdef'], $pobrecito['spe'], $pobrecito['creador'], $pobrecito['imagen'], $pobrecito['publico']);
        }else{
$controladorCreatura->modificar_creatura($pobrecito['id_creatura'], $pobrecito['nombre_creatura'], $pobrecito['id_tipo1'], 0, $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'], $pobrecito['def'], $pobrecito['spa'], $pobrecito['sdef'], $pobrecito['spe'], $pobrecito['creador'], $pobrecito['imagen'], $pobrecito['publico']);
        }

    }
}

        // Eliminar efectividades y el tipo
        echo "Elimininando efectividades." . "<br>";
        $controladorTipo->eliminar_efectividades($tipo['id_tipo']);
        echo "Elimininando tipo : " . $tipo['id_tipo'] . "<br>";
        $controladorTipo->baja_tipo($tipo['id_tipo']);
    }
}

// Eliminar ratings
echo "Elimininando ratings : " . "<br>";
$ratins = $controladorCreatura->listar_ratings_usuario($nickname);
if ($ratins && mysqli_num_rows($ratins) > 0) {
    while ($rating = mysqli_fetch_assoc($ratins)) {
        if (isset($rating['id_rating'])) {
            echo "ID de rating : " . $rating['id_rating'] . "<br>";
            $controladorCreatura->baja_rating($rating['id_rating']);
        }
}
}

// Eliminar creaturas
echo "Elimininando creturas : " . "<br>";
$creaturas = $controladorCreatura->listar_creaturas_ext(500, $nickname);
if ($creaturas && mysqli_num_rows($creaturas) > 0) {
    while ($creatura = mysqli_fetch_assoc($creaturas)) {
        if (isset($creatura['id_creatura'])) {
            echo "Elimininando creatura : " . $creatura['nombre_creatura'] . "<br>";
            $controladorCreatura->baja_creatura($creatura['id_creatura']);
        }
    }
}

// Finalmente, eliminar usuario
$controladorUsuario->baja_usuario($nickname);

session_destroy();

// Mostrar mensaje y redirigir
echo "ELIMINAR EXITOSO! Redirigiendo...";

ob_end_flush();

header("refresh:3; url=/Creatura_PHP/index.php");
?>
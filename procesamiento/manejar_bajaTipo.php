<?php

if (isset($_GET['id_tipo'])) {
    $id_tipo = urldecode($_GET['id_tipo']);
}

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

$tipo = $controladorTipo->retornar_tipo($id_tipo);

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

echo "ELIMINAR EXITOSO! Redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_tipo.php");

?>
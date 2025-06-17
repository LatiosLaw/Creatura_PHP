<?php

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['id_habilidad'])) {
    $id_habilidad = urldecode($_GET['id_habilidad']);
}

echo "Eliminando habilidad : " . "<br>";
$controladorCreatura->baja_habilidad($id_habilidad);

echo "ELIMINAR DE HABILIDAD EXITOSO! Redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_habilidad.php");

?>
<?php

if (isset($_GET['creador']) && isset($_GET['id_habilidad'])) {
    $creador = urldecode($_GET['creador']);
    $id_habilidad = urldecode($_GET['id_habilidad']);
}

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$potencia = $_POST['potencia'];
$descripcion = $_POST['descripcion'];

if($controladorCreatura->modificar_habilidad($id_habilidad, $nombre, $tipo, $descripcion, $categoria, $potencia, $creador) == 1){
echo "Modificacion de habilidad exitosa, redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_habilidad.php");
}else{
echo "no funca, algo valio vrga, redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_habilidad.php");
}

?>
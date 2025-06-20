<?php

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$potencia = $_POST['potencia'];
$descripcion = $_POST['descripcion'];

session_start();

$creador = $_SESSION['nickname'];

$descripcion = empty($descripcion) ? "" : $descripcion;

if($controladorCreatura->alta_habilidad($nombre, $tipo, $descripcion, $categoria, $potencia, $creador) == 1){
echo "Alta de habilidad exitosa, redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_habilidad.php");
}else{
echo "no funca, algo valio vrga, redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_habilidad.php");
}

?>
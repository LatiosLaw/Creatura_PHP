<?php

include_once("../clases/conexion.php");
$controladorConexion = new Conexion();
$conexion = $controladorConexion->conectar();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$potencia = $_POST['potencia'];
$descripcion = $_POST['descripcion'];

session_start(); // ¡Muy importante! Siempre al inicio

$creador = $_SESSION['nickname'];

if($controladorCreatura->alta_habilidad($nombre, $tipo, $descripcion, $categoria, $potencia, $creador, $conexion) == 1){
echo "Alta de habilidad exitosa, redirigiendo...";
header("refresh:3; url=../paginas/ej_alta_habilidad.php");
}else{
echo "no funca, algo valio vrga, redirigiendo...";
header("refresh:3; url=../paginas/ej_alta_habilidad.php");
}

?>
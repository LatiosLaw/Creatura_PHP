<?php 

session_start();

include_once("../clases/conexion.php");
$controladorConexion = new Conexion();
$conexion = $controladorConexion->conectar();

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$nickname = $_POST['nickname'];
$contra = $_POST['contra'];

$usuario_encontrado = $controladorUsuario->retornar_usuario_personal($nickname, $conexion);
$contra2 = $usuario_encontrado["contraseña"];

if(strcmp($contra2, $contra) == 0){
$_SESSION['nickname'] = $usuario_encontrado["nickname"];
echo "LOGIN EXITOSO! Redirigiendo...";
header("refresh:3; url=../paginas/ej_login.php");
}else{
echo "Credenciales incorrectas, redirigiendo...";
header("refresh:3; url=../paginas/ej_login.php");
}
?>
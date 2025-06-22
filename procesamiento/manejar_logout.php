<?php
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Mostrar mensaje y redirigir
echo "LOGOUT EXITOSO! Redirigiendo...";
header("refresh:3; url=../index.php");
exit;
?>
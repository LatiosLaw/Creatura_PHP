<?php
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Detectar la última página
$paginaAnterior = $_SERVER['HTTP_REFERER'] ?? '../index.php';

// Mostrar mensaje y redirigir
echo "LOGOUT EXITOSO! Redirigiendo...";
header("refresh:3; url=$paginaAnterior");
exit;
?>
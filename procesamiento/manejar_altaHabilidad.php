<?php

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

session_start();

// Validar sesión
if (!isset($_SESSION['nickname'])) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=alta_habilidad_sin_sesion");
    exit();
}

$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$potencia = $_POST['potencia'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$creador = $_SESSION['nickname'];

// Validaciones básicas (ejemplo)
if (empty($nombre) || empty($tipo) || empty($categoria) || !is_numeric($potencia)) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=alta_habilidad_campos_invalidos");
    exit();
}

// Intentar alta
$resultado = $controladorCreatura->alta_habilidad($nombre, $tipo, $descripcion, $categoria, $potencia, $creador);

if ($resultado == 1) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?success=alta_habilidad_exitosa");
    exit();
} else {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=fallo_alta_habilidad");
    exit();
}

<?php
session_start();  // Es recomendable usar sesión para verificar permisos (no lo añadiste, pero es buena práctica)

if (!isset($_SESSION['nickname'])) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=mod_habilidad_sin_sesion");
    exit();
}

if (!isset($_GET['creador']) || !isset($_GET['id_habilidad'])) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=mod_habilidad_parametros_faltantes");
    exit();
}

$creador = urldecode($_GET['creador']);
$id_habilidad = urldecode($_GET['id_habilidad']);

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$potencia = $_POST['potencia'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$descripcion = empty($descripcion) ? "" : $descripcion;

$exito = $controladorCreatura->modificar_habilidad($id_habilidad, $nombre, $tipo, $descripcion, $categoria, $potencia, $creador);

if ($exito == 1) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?success=modificacion_habilidad_exitosa");
} else {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=fallo_modificar_habilidad");
}
exit();

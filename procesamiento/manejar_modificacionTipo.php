<?php
session_start();

if (!isset($_GET['id_tipo'])) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=id_tipo_faltante");
    exit();
}

$id_tipo = urldecode($_GET['id_tipo']);

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$nombre_original = $_POST['nombre_original'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$color = $_POST['color'] ?? '';
$color = ltrim($color, '#');

$debilidades = $_POST['debilidad'] ?? [];
$resistencias = $_POST['resistencia'] ?? [];
$inmunidades = $_POST['inmunidad'] ?? [];

if (empty($nombre_original) || empty($nombre) || empty($color)) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=campos_obligatorios_vacios");
    exit();
}

$tipo_viejo = $controladorTipo->retornar_tipo($id_tipo);
if (!$tipo_viejo) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=tipo_no_encontrado");
    exit();
}

$nombreArchivo = null;
$subioIcono = false;

if (isset($_FILES['icono']) && $_FILES['icono']['error'] === UPLOAD_ERR_OK) {
    $icono = $_FILES['icono'];
    $nombreArchivo = $icono['name'];
    $tmpArchivo = $icono['tmp_name'];
    $tipoArchivo = $icono['type'];

    // Validar tipo MIME si quieres (opcional)
    if (!in_array($tipoArchivo, ['image/jpeg', 'image/png'])) {
        header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=icono_tipo_no_valido");
        exit();
    }

    $exito_mod = $controladorTipo->modificar_tipo($nombre_original, $nombre, $color, $nombreArchivo, $tipo_viejo['creador']);
    if (!$exito_mod) {
        header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_modificacion_tipo");
        exit();
    }

    $destino = "../imagenes/tipos/" . basename($nombreArchivo);
    if (!move_uploaded_file($tmpArchivo, $destino)) {
        header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_subida_icono");
        exit();
    }
    $subioIcono = true;
} else {
    // Modificar sin cambiar icono
    $exito_mod = $controladorTipo->modificar_tipo($nombre_original, $nombre, $color, $tipo_viejo['icono'], $tipo_viejo['creador']);
    if (!$exito_mod) {
        header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_modificacion_tipo");
        exit();
    }
}

// Actualizar efectividades
if (!$controladorTipo->eliminar_efectividades($id_tipo)) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_eliminar_efectividades");
    exit();
}

foreach ($resistencias as $resis) {
    $controladorTipo->alta_efectividad($resis, $id_tipo, 0.5);
}
foreach ($debilidades as $deb) {
    $controladorTipo->alta_efectividad($deb, $id_tipo, 2);
}
foreach ($inmunidades as $inmu) {
    $controladorTipo->alta_efectividad($inmu, $id_tipo, 0);
}

header("Location: /Creatura_PHP/paginas/gestor_tipo.php?success=modificacion_tipo_exitosa");
exit();
?>

<?php
require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

session_start();
if (!isset($_SESSION['nickname'])) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=alta_tipo_sin_sesion");
    exit();
}

$nombre = $_POST['nombre'] ?? '';
$color = isset($_POST['color']) ? ltrim($_POST['color'], '#') : '';
$self_int = $_POST['self-int'] ?? 1;
$creador = $_SESSION['nickname'];

$nombreArchivo = null;
$tmpArchivo = null;

// Subida de ícono
if (isset($_FILES['icono']) && $_FILES['icono']['error'] === UPLOAD_ERR_OK) {
    $icono = $_FILES['icono'];
    $nombreArchivo = basename($icono['name']);
    $tipoArchivo = $icono['type'];
    $tmpArchivo = $icono['tmp_name'];

    // Validar tipo MIME
    if (!in_array($tipoArchivo, ['image/jpeg', 'image/png'])) {
        header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=alta_tipo_icono_no_valido");
        exit();
    }
}

$debilidades = $_POST['debilidad'] ?? [];
$resistencias = $_POST['resistencia'] ?? [];
$inmunidades = $_POST['inmunidad'] ?? [];

// Alta de tipo
if ($controladorTipo->alta_tipo($nombre, $color, $nombreArchivo, $creador) == 1) {
    // Subir imagen si corresponde
    if ($nombreArchivo !== null) {
        $destino = "../imagenes/tipos/" . $nombreArchivo;
        if (!move_uploaded_file($tmpArchivo, $destino)) {
            header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=alta_tipo_fallo_subida_imagen");
            exit();
        }
    }

    $tipo_creado = $controladorTipo->retornar_tipo_por_creador($nombre, $creador);
    $id_tipo = $tipo_creado['id_tipo'];

    // Registrar efectividades
    foreach ($resistencias as $resis) {
        $controladorTipo->alta_efectividad($resis, $id_tipo, 0.5);
    }
    foreach ($debilidades as $deb) {
        $controladorTipo->alta_efectividad($deb, $id_tipo, 2);
    }
    foreach ($inmunidades as $inmu) {
        $controladorTipo->alta_efectividad($inmu, $id_tipo, 0);
    }
    if ($self_int != 1) {
        $controladorTipo->alta_efectividad($id_tipo, $id_tipo, $self_int);
    }

    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?success=alta_tipo_exitosa");
    exit();
} else {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_alta_tipo");
    exit();
}
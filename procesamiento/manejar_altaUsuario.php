<?php
require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

session_start();

// Recolección de datos
$nickname   = $_POST['nickname'] ?? '';
$correo     = $_POST['correo'] ?? '';
$contra     = $_POST['contra'] ?? '';
$contra2    = $_POST['ver_contra'] ?? '';
$biografia  = $_POST['biografia'] ?? '';
$biografia  = trim($biografia);

// Validaciones mínimas
if (empty($nickname) || empty($correo) || empty($contra) || empty($contra2)) {
    header("Location: ../index.php?error=alta_usuario_campos_vacios");
    exit();
}

if ($contra !== $contra2) {
    header("Location: ../index.php?error=alta_usuario_contrasenas_diferentes");
    exit();
}

// Validar email (sintaxis básica)
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?error=alta_usuario_email_invalido");
    exit();
}

// Validar imagen (opcional)
$nombreArchivo = '';
$tmpArchivo = '';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto         = $_FILES['foto'];
    $tipoArchivo  = $foto['type'];
    $nombreArchivo = basename($foto['name']);
    $tmpArchivo   = $foto['tmp_name'];

    // Solo permitir PNG o JPEG
    if (!in_array($tipoArchivo, ['image/jpeg', 'image/png'])) {
        header("Location: ../index.php?error=alta_usuario_foto_invalida");
        exit();
    }
}

// Alta en BD
$verificacion = $controladorUsuario->alta_usuario($nickname, $correo, $nombreArchivo, $biografia, $contra, "usuario");

if ($verificacion == 1) {
    // Si se subió foto, moverla
    if ($nombreArchivo !== '') {
        $destino = "../imagenes/usuarios/" . $nombreArchivo;
        if (!move_uploaded_file($tmpArchivo, $destino)) {
            header("Location: ../index.php?error=alta_usuario_fallo_subida_foto");
            exit();
        }
    }

    header("Location: ../index.php?success=alta_usuario_exitosa");
    exit();
} else {
    // Usuario o correo ya existe
    header("Location: ../index.php?error=alta_usuario_nick_o_correo_repetido");
    exit();
}

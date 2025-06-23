<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$nickname = $_POST['nickname'] ?? '';
$correo = $_POST['correo'] ?? '';
$biografia = $_POST['biografia'] ?? '';
$contra = $_POST['contra'] ?? '';
$ver_contra = $_POST['ver_contra'] ?? '';

$usuario_viejo = $controladorUsuario->retornar_usuario_personal($nickname);

$nombreArchivo = null;

// Validar que nickname y correo no estén vacíos
if (empty($nickname) || empty($correo)) {
    header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&error=campos_vacios");
    exit;
}

// Verificar disponibilidad solo si cambian nickname o correo
$nickname_original = $usuario_viejo['nickname'] ?? '';
$correo_original = $usuario_viejo['correo'] ?? '';

if (($nickname !== $nickname_original) || ($correo !== $correo_original)) {
    if ($controladorUsuario->verificar_disponibilidad($nickname, $correo, $nickname_original, $correo_original) != 1) {
        header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&error=nick_correo_repetido");
        exit;
    }
}

// Manejo de contraseña
if (!empty($contra)) {
    if ($contra !== $ver_contra) {
        header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&error=contrasenas_no_coinciden");
        exit;
    }
} else {
    // Mantener contraseña anterior si no se ingresó nueva
    $contra = $usuario_viejo['contraseña'] ?? '';
}

// Manejo de foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto'];
    $nombreArchivo = $foto['name'];
    $tmpArchivo = $foto['tmp_name'];
    $destino = "../imagenes/usuarios/" . basename($nombreArchivo);

    if (!move_uploaded_file($tmpArchivo, $destino)) {
        header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&error=error_subida_foto");
        exit;
    }
} else {
    $nombreArchivo = $usuario_viejo['foto'] ?? '';
}

// Tipo del usuario, lo mantenemos
$tipo = $usuario_viejo['tipo'] ?? 'usuario';

// Modificar usuario
$resultado = $controladorUsuario->modificar_usuario($nickname, $correo, $nombreArchivo, $biografia, $contra, $tipo);

if ($resultado == 1) {
    header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&success=modificacion_usuario_exitosa");
} else {
    header("Location: /Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname&error=fallo_modificacion");
}
exit;

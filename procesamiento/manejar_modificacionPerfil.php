<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$biografia = $_POST['biografia'];
$contra = $_POST['contra'];
$ver_contra = $_POST['ver_contra'];

$usuario_viejo = $controladorUsuario->retornar_usuario_personal($nickname);

$nombreArchivo = null;

// Verificar si se recibió el archivo
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto'];
    $nombreArchivo = $foto['name'];
    $tmpArchivo = $foto['tmp_name'];
}

if ($controladorUsuario->verificar_disponibilidad($nickname, $correo, $nickname, $correo) == 1) {

    // === Manejo de contraseña ===
    if (!empty($contra)) {
    // Se ingresó nueva contraseña, validar que coincidan
    if (strcmp($contra, $ver_contra) !== 0) {
        echo "Las contraseñas no son iguales, redirigiendo...";
        header("refresh:3; url=/Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname");
        exit;
    }
} else {
    // No se ingresó nueva contraseña, mantener la anterior
    $contra = $usuario_viejo['contraseña'];
}


    $tipo = $usuario_viejo['tipo'];

    // === Foto de perfil ===
    if ($nombreArchivo !== null) {
        $destino = "../imagenes/usuarios/" . basename($nombreArchivo);
        if (move_uploaded_file($tmpArchivo, $destino)) {
            echo "La foto se subió correctamente.<br>";
        } else {
            echo "Error al mover el archivo.<br>";
        }
    } else {
        $nombreArchivo = $usuario_viejo['foto'];
    }

    // === Modificación ===
    $resultado = $controladorUsuario->modificar_usuario(
        $nickname,
        $correo,
        $nombreArchivo,
        $biografia,
        $contra,
        $tipo
    );
}

// === Redirección final ===
if ($resultado == 1) {
    echo "FUNCA, redirigiendo...";
} else {
    echo "NO funca, redirigiendo...";
}
header("refresh:3; url=/Creatura_PHP/paginas/ver_usuario.php?usuario=$nickname");
?>
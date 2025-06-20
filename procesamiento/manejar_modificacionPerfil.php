<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$nick_viejo = $_POST['nick_viejo'];
$correo_viejo = $_POST['correo_viejo'];

$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$biografia = $_POST['biografia'];

$usuario_viejo = $controladorUsuario->retornar_usuario_personal($nick_viejo);

$nombreArchivo = null;

// Verificar si se recibió el archivo
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto'];

    $nombreArchivo = $foto['name'];
    $tipoArchivo = $foto['type'];
    $tamanoArchivo = $foto['size'];
    $tmpArchivo = $foto['tmp_name'];
}

if($controladorUsuario->verificar_disponibilidad($nickname, $correo, $nick_viejo, $correo_viejo) == 1){

    $contra_vieja = $usuario_viejo['contraseña'];
    $tipo = $usuario_viejo['tipo'];

    if($nombreArchivo!=null){

        $destino = "../imagenes/usuarios/" . basename($nombreArchivo);
        if (move_uploaded_file($tmpArchivo, $destino)) {
            echo "La foto se subió correctamente.";
            echo "<br>";
        } else {
            echo "Error al mover el archivo.";
            echo "<br>";
        }

        $resultado = $controladorUsuario->modificar_usuario($nick_viejo, $correo, $nombreArchivo, $biografia, $contra_vieja, $tipo);
    }else{
        $imagen_vieja = $usuario_viejo['foto'];
        $resultado = $controladorUsuario->modificar_usuario($nick_viejo, $correo, $imagen_vieja, $biografia, $contra_vieja, $tipo);
    }
}

if($resultado==1){
echo "FUNCA, redirigiendo...";
    header("refresh:3; url=/Creatura_PHP/paginas/ver_usuario.php?usuario=$nick_viejo");
}else{
    echo "NO funca, redirigiendo...";
    header("refresh:3; url=/Creatura_PHP/paginas/ver_usuario.php?usuario=$nick_viejo");
}

?>
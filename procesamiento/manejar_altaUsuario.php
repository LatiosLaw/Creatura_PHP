<?php 

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$contra = $_POST['contra'];
$contra2 = $_POST['ver_contra'];
$biografia = $_POST['biografia'];

// Verificar si se recibió el archivo
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto'];

    $nombreArchivo = $foto['name'];
    $tipoArchivo = $foto['type'];
    $tamanoArchivo = $foto['size'];
    $tmpArchivo = $foto['tmp_name'];
}

$paginaAnterior = $_SERVER['HTTP_REFERER'] ?? '../index.php';

if($contra == $contra2){
$verifiacion = $controladorUsuario->alta_usuario($nickname, $correo, $nombreArchivo, $biografia, $contra, "usuario");
if($verifiacion == 1){

    $destino = "../imagenes/usuarios/" . basename($nombreArchivo);
    if (move_uploaded_file($tmpArchivo, $destino)) {
        echo "La foto se subió correctamente.";
        echo "<br>";
    } else {
        echo "Error al mover el archivo.";
        echo "<br>";
    }

echo "funca, redirigiendo...";
header("refresh:3; url=$paginaAnterior");

}else{
echo "correo o nick repetido, redirigiendo...";
header("refresh:3; url=$paginaAnterior");
}

}else{
echo "No funca, contraseñas no coinciden, redirigiendo...";
header("refresh:3; url=$paginaAnterior");
}

?>
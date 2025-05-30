<?php

include_once("../clases/conexion.php");
$controladorConexion = new Conexion();
$conexion = $controladorConexion->conectar();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$nombre = $_POST['nombre'];
$color = $_POST['color'];
$color = ltrim($_POST['color'], '#');

session_start();

$creador = $_SESSION['nickname'];

$nombreArchivo = null;

if (isset($_FILES['icono']) && $_FILES['icono']['error'] === UPLOAD_ERR_OK) {
    $icono = $_FILES['icono'];

    $nombreArchivo = $icono['name'];
    $tipoArchivo = $icono['type'];
    $tamanoArchivo = $icono['size'];
    $tmpArchivo = $icono['tmp_name'];
}

$debilidades = isset($_POST['debilidad']) ? $_POST['debilidad'] : [];
$resistencias = isset($_POST['resistencia']) ? $_POST['resistencia'] : [];
$inmunidades = isset($_POST['inmunidad']) ? $_POST['inmunidad'] : [];

if ($controladorTipo->alta_tipo($nombre, $color, $nombreArchivo, $creador, $conexion) == 1) {

    if ($nombreArchivo != null) {
        $destino = "../imagenes/" . basename($nombreArchivo);
        if (move_uploaded_file($tmpArchivo, $destino)) {
            echo "La foto se subió correctamente.";
            echo "<br>";
        } else {
            echo "Error al mover el archivo.";
            echo "<br>";
        }
    }

    $tipo_creado = $controladorTipo->retornar_tipo_por_creador($nombre, $creador, $conexion);

    echo $tipo_creado['id_tipo'];

    foreach ($resistencias as $resis) {
        $controladorTipo->alta_efectividad($resis, $tipo_creado['id_tipo'], 0.5, $conexion);
    }
    foreach ($debilidades as $deb) {
        $controladorTipo->alta_efectividad($deb, $tipo_creado['id_tipo'], 2, $conexion);
    }
    foreach ($inmunidades as $inmu) {
        $controladorTipo->alta_efectividad($inmu, $tipo_creado['id_tipo'], 0, $conexion);
    }

    echo "funca, redirigiendo...";
    header("refresh:3; url=../paginas/ej_alta_tipo.php");
} else {
    echo "no funca, redirigiendo...";
    header("refresh:3; url=../paginas/ej_alta_tipo.php");
}

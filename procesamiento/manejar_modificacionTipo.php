<?php

if (isset($_GET['id_tipo'])) {
    $id_tipo = urldecode($_GET['id_tipo']);
}

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$nombre = $_POST['nombre'];
$color = $_POST['color'];
$color = ltrim($_POST['color'], '#');

session_start();

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

$tipo_viejo = $controladorTipo->retornar_tipo($id_tipo);

if($nombreArchivo!=null){

$controladorTipo->modificar_tipo($nombre, $color, $nombreArchivo, $tipo_viejo['creador']);

        $destino = "../imagenes/tipos/" . basename($nombreArchivo);
        if (move_uploaded_file($tmpArchivo, $destino)) {
            echo "La foto se subió correctamente.";
            echo "<br>";
        } else {
            echo "Error al mover el archivo.";
            echo "<br>";
        }

}else{

$controladorTipo->modificar_tipo($nombre, $color, $tipo_viejo['icono'], $tipo_viejo['creador']);

}

    $controladorTipo->eliminar_efectividades($id_tipo);

    foreach ($resistencias as $resis) {
        $controladorTipo->alta_efectividad($resis, $id_tipo, 0.5);
    }
    foreach ($debilidades as $deb) {
        $controladorTipo->alta_efectividad($deb, $id_tipo, 2);
    }
    foreach ($inmunidades as $inmu) {
        $controladorTipo->alta_efectividad($inmu, $id_tipo, 0);
    }

    echo "funca, redirigiendo...";
    header("refresh:3; url=/Creatura_PHP/paginas/gestor_tipo.php");

?>
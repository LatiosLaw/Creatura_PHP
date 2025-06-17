<?php

if (isset($_GET['id_creatura'])) {
    $id_creatura = urldecode($_GET['id_creatura']);
    $creador = urldecode($_GET['creador']);
    $nombre_creatura = urldecode($_GET['nombre_creatura']);
}

session_start();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_SESSION['nickname'])) {
    die("No tienes permiso para realizar esta acción.");
}else{
    $nickname = $_SESSION['nickname'];
}

    // Variables básicas
    $nombre = $_POST['nombre'] ?? '-';
    $tipo1 = empty($_POST['tipo1']) ? '0' : $_POST['tipo1'];
    $tipo2 = empty($_POST['tipo2']) ? '0' : $_POST['tipo2'];
    $descripcion = $_POST['descripcion'] ?? '-';

    // Estadísticas
    $hp = $_POST['hp'] ?? 70;
    $atk = $_POST['atk'] ?? 70;
    $def = $_POST['def'] ?? 70;
    $spa = $_POST['spa'] ?? 70;
    $spdef = $_POST['spdef'] ?? 70;
    $spe = $_POST['spe'] ?? 70;

    $controladorCreatura->borrar_moveset_por_creatura($id_creatura);

    $creatura_vieja = $controladorCreatura->retornar_creatura($nombre_creatura, $creador);

    // Habilidades (JSON decodificado a array asociativo)
    $habilidades_json = $_POST['habilidades_json'] ?? '[]';
    $habilidades = json_decode($habilidades_json, true);

    $nombreArchivo = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = $_FILES['imagen'];

    $nombreArchivo = $imagen['name'];
    $tipoArchivo = $imagen['type'];
    $tamanoArchivo = $imagen['size'];
    $tmpArchivo = $imagen['tmp_name'];

    $controladorCreatura->modificar_creatura($id_creatura, $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $creador, $nombreArchivo, 0);
}else{
    $controladorCreatura->modificar_creatura($id_creatura, $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $creador, $creatura_vieja['imagen'], 0);
}

    foreach($habilidades as $hab){
        $controladorCreatura->alta_moveset($id_creatura, $hab['id']);
    }

    if ($nombreArchivo != null) {
        $destino = "../imagenes/creaturas/" . basename($nombreArchivo);
        if (move_uploaded_file($tmpArchivo, $destino)) {
            echo "La foto se subió correctamente.";
            echo "<br>";
        } else {
            echo "Error al mover el archivo.";
            echo "<br>";
        }
    }

    echo "funca, redirigiendo...";
    header("refresh:3; url=../paginas/gestor_creatura.php");

?>
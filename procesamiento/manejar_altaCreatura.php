<?php
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

    $publico = $_POST['publico'] ?? '0';

    // Estadísticas
    $hp = $_POST['hp'] ?? 70;
    $atk = $_POST['atk'] ?? 70;
    $def = $_POST['def'] ?? 70;
    $spa = $_POST['spa'] ?? 70;
    $spdef = $_POST['spdef'] ?? 70;
    $spe = $_POST['spe'] ?? 70;

    // Habilidades (JSON decodificado a array asociativo)
    $habilidades_json = $_POST['habilidades_json'] ?? '[]';
    $habilidades = json_decode($habilidades_json, true);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = $_FILES['imagen'];

    $nombreArchivo = $imagen['name'];
    $tipoArchivo = $imagen['type'];
    $tamanoArchivo = $imagen['size'];
    $tmpArchivo = $imagen['tmp_name'];

function limpiar_cadena($cadena) {
    $cadena = str_replace(["'", '"', '\\'], '', $cadena);
    return trim($cadena);
}

$nombre = limpiar_cadena($_POST['nombre'] ?? '-');
$descripcion = limpiar_cadena($_POST['descripcion'] ?? '-');

    $id_creatura_nueva = $controladorCreatura->alta_creatura($nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $nickname, $nombreArchivo, $publico);
}else{
    $id_creatura_nueva = $controladorCreatura->alta_creatura($nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $nickname, null, $publico);
}

if($habilidades!=null){
    foreach($habilidades as $hab){
        $controladorCreatura->alta_moveset($id_creatura_nueva, $hab['id']);
    }
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
    header("refresh:3; url=/Creatura_PHP/paginas/gestor_creatura.php");

    // Aquí podrías continuar con lógica de validación, sanitización o inserción en base de datos.
?>

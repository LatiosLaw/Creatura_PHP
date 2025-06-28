<?php
session_start();

if (!isset($_SESSION['nickname'])) {
    // No hay sesión, salir o redirigir con error
    header("Location: ../paginas/gestor_creatura.php?error=sin_sesion");
    exit();
}

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_GET['id_creatura']) || !isset($_GET['creador']) || !isset($_GET['nombre_creatura'])) {
    header("Location: ../paginas/gestor_creatura.php?error=parametros_faltantes");
    exit();
}

$id_creatura = urldecode($_GET['id_creatura']);
$creador = urldecode($_GET['creador']);
$nombre_creatura = urldecode($_GET['nombre_creatura']);

$nickname = $_SESSION['nickname'];

// Variables básicas con valores por defecto
$nombre = $_POST['nombre'] ?? '-';
$tipo1 = empty($_POST['tipo1']) ? '0' : $_POST['tipo1'];
$tipo2 = empty($_POST['tipo2']) ? '0' : $_POST['tipo2'];
$descripcion = $_POST['descripcion'] ?? '-';

// Estadísticas con valores por defecto
$hp = $_POST['hp'] ?? 70;
$atk = $_POST['atk'] ?? 70;
$def = $_POST['def'] ?? 70;
$spa = $_POST['spa'] ?? 70;
$spdef = $_POST['spdef'] ?? 70;
$spe = $_POST['spe'] ?? 70;

$publico = $_POST['publico'] ?? '0';

$habilidades_json = $_POST['habilidades_json'] ?? '[]';
$habilidades = json_decode($habilidades_json, true);

// Si no es un array válido, lo tratamos como vacío
if (!is_array($habilidades)) {
    $habilidades = [];
}

// Borrar moveset previo
if (!$controladorCreatura->borrar_moveset_por_creatura($id_creatura)) {
    header("Location: ../paginas/gestor_creatura.php?error=fallo_borrar_moveset");
    exit();
}

$creatura_vieja = $controladorCreatura->retornar_creatura($nombre_creatura, $creador);

$nombreArchivo = null;
$subioImagen = false;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = $_FILES['imagen'];

    $nombreArchivo = $imagen['name'];
    $tipoArchivo = $imagen['type'];
    $tamanoArchivo = $imagen['size'];
    $tmpArchivo = $imagen['tmp_name'];

    $exitoModificacion = $controladorCreatura->modificar_creatura($id_creatura, $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $creador, $nombreArchivo, $publico);
    if (!$exitoModificacion) {
        header("Location: ../paginas/gestor_creatura.php?error=fallo_modificar_creatura");
        exit();
    }

    $destino = "../imagenes/creaturas/" . basename($nombreArchivo);
    if (move_uploaded_file($tmpArchivo, $destino)) {
        $subioImagen = true;
    } else {
        header("Location: ../paginas/gestor_creatura.php?error=fallo_subida_imagen");
        exit();
    }
} else {
    // Modificar con imagen previa
    $exitoModificacion = $controladorCreatura->modificar_creatura($id_creatura, $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def, $spa, $spdef, $spe, $creador, $creatura_vieja['imagen'], $publico);
    if (!$exitoModificacion) {
        header("Location: ../paginas/gestor_creatura.php?error=fallo_modificar_creatura");
        exit();
    }
}

// Agregar habilidades nuevas
foreach ($habilidades as $hab) {
    if (isset($hab['id'])) {
        $controladorCreatura->alta_moveset($id_creatura, $hab['id']);
    }
}

header("Location: ../paginas/gestor_creatura.php?success=modificacion_exitosa");
exit();
?>

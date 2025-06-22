<?php
session_start();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_SESSION['nickname'])) {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=alta_no_sesion");
    exit;
} else {
    $nickname = $_SESSION['nickname'];
}

// Función para limpiar cadenas
function limpiar_cadena($cadena) {
    $cadena = str_replace(["'", '"', '\\'], '', $cadena);
    return trim($cadena);
}

// Variables básicas (sanitizadas)
$nombre = limpiar_cadena($_POST['nombre'] ?? '-');
$tipo1 = empty($_POST['tipo1']) ? '0' : $_POST['tipo1'];
$tipo2 = empty($_POST['tipo2']) ? '0' : $_POST['tipo2'];
$descripcion = limpiar_cadena($_POST['descripcion'] ?? '-');
$publico = $_POST['publico'] ?? '0';

// Estadísticas con validación básica de enteros y rangos
$hp = isset($_POST['hp']) ? (int)$_POST['hp'] : 70;
$atk = isset($_POST['atk']) ? (int)$_POST['atk'] : 70;
$def = isset($_POST['def']) ? (int)$_POST['def'] : 70;
$spa = isset($_POST['spa']) ? (int)$_POST['spa'] : 70;
$spdef = isset($_POST['spdef']) ? (int)$_POST['spdef'] : 70;
$spe = isset($_POST['spe']) ? (int)$_POST['spe'] : 70;

// Habilidades (JSON decodificado a array asociativo)
$habilidades_json = $_POST['habilidades_json'] ?? '[]';
$habilidades = json_decode($habilidades_json, true);
if ($habilidades === null) {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=alta_json_habilidades_invalido");
    exit;
}

$nombreArchivo = null;
$tmpArchivo = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = $_FILES['imagen'];

    $nombreArchivo = $imagen['name'];
    $tmpArchivo = $imagen['tmp_name'];

    // Validar tipo y tamaño si querés
    $allowed_types = ['image/jpeg', 'image/png'];
    if (!in_array($imagen['type'], $allowed_types)) {
        header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=tipo_imagen_no_valido");
        exit;
    }
    if ($imagen['size'] > 5 * 1024 * 1024) { // max 5MB
        header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=tamano_imagen_excedido");
        exit;
    }
}

// Crear creatura
$id_creatura_nueva = $controladorCreatura->alta_creatura(
    $nombre, $tipo1, $tipo2, $descripcion,
    $hp, $atk, $def, $spa, $spdef, $spe,
    $nickname,
    $nombreArchivo,
    $publico
);

if (!$id_creatura_nueva) {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=fallo_alta_creatura");
    exit;
}

// Alta moveset
if ($habilidades != null && is_array($habilidades)) {
    foreach ($habilidades as $hab) {
        if (isset($hab['id'])) {
            $res = $controladorCreatura->alta_moveset($id_creatura_nueva, $hab['id']);
            if (!$res) {
                header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=fallo_alta_moveset");
                exit;
            }
        }
    }
}

// Mover imagen si existe
if ($nombreArchivo != null && $tmpArchivo != null) {
    $destino = "../imagenes/creaturas/" . basename($nombreArchivo);
    if (!move_uploaded_file($tmpArchivo, $destino)) {
        header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=fallo_subida_imagen");
        exit;
    }
}

// Éxito
header("Location: /Creatura_PHP/paginas/gestor_creatura.php?success=alta_creatura_exitosa");
exit;


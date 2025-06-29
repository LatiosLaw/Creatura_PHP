<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/tipo.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

if (!isset($_GET['creador'])) {
    exitJson(400, 'creador_faltante', 'Falta creador en la URL.');
}

$creador = $_GET['creador'];
$controlador = new Tipo();
$tipos = $controlador->listar_tipos_creador($creador);

// Ruta física a imágenes
$ruta_imagenes = $_SERVER['DOCUMENT_ROOT'] . "/Creatura_PHP/imagenes/tipos/";

foreach ($tipos as &$tipo) {
    $icono_archivo = $tipo['icono'];

    if (!$icono_archivo) {
        // Si no hay nombre de archivo, asignar cadena vacía y saltar
        $tipo['icono'] = "";
        continue;
    }

    $ruta_icono = $ruta_imagenes . $icono_archivo;

    if (file_exists($ruta_icono)) {
        $contenido = file_get_contents($ruta_icono);
        $mime_type = mime_content_type($ruta_icono);
        $base64 = base64_encode($contenido);
        $tipo['icono'] = "data:$mime_type;base64,$base64";
    } else {
        $tipo['icono'] = "";
    }
}

echo json_encode($tipos);
exit;

function exitJson($status, $codigo, $mensaje) {
    http_response_code($status);
    echo json_encode([
        "resultado" => "error",
        "codigo"    => $codigo,
        "mensaje"   => $mensaje
    ]);
    exit;
}

<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Ajusta según tu dominio
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Responder preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido, use DELETE"
    ]);
    exit();
}

require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

// Obtener id_habilidad desde query string
if (!isset($_GET['id_habilidad'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Falta id_habilidad"
    ]);
    exit();
}

$id_habilidad = urldecode($_GET['id_habilidad']);

// Validar que sea entero positivo
if (!ctype_digit($id_habilidad) || intval($id_habilidad) <= 0) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "id_habilidad inválido"
    ]);
    exit();
}

$resultado = $controladorCreatura->baja_habilidad($id_habilidad);

if ($resultado) {
    http_response_code(200);
    echo json_encode([
        "resultado" => "ok",
        "mensaje" => "Habilidad eliminada correctamente"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Error al eliminar la habilidad"
    ]);
}

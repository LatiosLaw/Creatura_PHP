<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Manejo explícito de preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/creatura.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Validar parámetros
if (!isset($_GET['id_habilidad'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros"
    ]);
    exit;
}

$id_habilidad = urldecode($_GET['id_habilidad']);

$controlador = new Creatura();
$habilidad = $controlador->retornar_habilidad_id($id_habilidad);

if ($habilidad) {
    echo json_encode([
        "resultado" => "ok",
        "habilidad" => $habilidad
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Habilidad no encontrada"
    ]);
}

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

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
if (!isset($_GET['id_creatura'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: nombre_creatura y creador"
    ]);
    exit;
}

$id_creatura = urldecode($_GET['id_creatura']);

$controlador = new Creatura();
$creatura = $controlador->retornar_creatura_API($id_creatura);

if ($creatura) {
    echo json_encode([
        "resultado" => "ok",
        "creatura" => $creatura
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Creatura no encontrada"
    ]);
}

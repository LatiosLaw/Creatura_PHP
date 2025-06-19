<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

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
if (!isset($_GET['nombre_creatura']) || !isset($_GET['creador'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: nombre_creatura y creador"
    ]);
    exit;
}

$nombre_creatura = urldecode($_GET['nombre_creatura']);
$creador = urldecode($_GET['creador']);

$controlador = new Creatura();
$creatura = $controlador->retornar_creatura_API($nombre_creatura, $creador);

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

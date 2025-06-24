<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

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

if (!isset($_GET['creador'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Falta el parámetro 'id_tipo'"
    ]);
    exit;
}
$creador = $_GET['creador'];

$controladorCreatura = new Creatura();

$habilidades = $controladorCreatura->retornar_habilidades_creador($creador);

header('Content-Type: application/json');

echo json_encode([
    "resultado" => "ok",
    "habilidades" => $habilidades
]);
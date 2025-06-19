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

if (!isset($_GET['id_creatura'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Falta el parámetro 'id_creatura'"
    ]);
    exit;
}

$id_creatura = intval($_GET['id_creatura']);

$controlador = new Creatura();
$habilidades = $controlador->retornar_habilidades_API($id_creatura);

echo json_encode([
    "resultado" => "ok",
    "habilidades" => $habilidades
]);

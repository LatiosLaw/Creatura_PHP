<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/tipo.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}
$controladorTipo = new Tipo();

$habilidades = $controladorTipo->retornar_habilidades_api();

header('Content-Type: application/json');

echo json_encode([
    "resultado" => "ok",
    "habilidades" => $habilidades
]);
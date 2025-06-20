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
if (!isset($_GET['id_tipo'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Falta el parámetro 'id_tipo'"
    ]);
    exit;
}
$id_tipo = intval($_GET['id_tipo']);

$controladorTipo = new Tipo();

$habilidades = $controladorTipo->retornar_habilidades_tipo($id_tipo);

header('Content-Type: application/json');

echo json_encode([
    "resultado" => "ok",
    "habilidades" => $habilidades
]);
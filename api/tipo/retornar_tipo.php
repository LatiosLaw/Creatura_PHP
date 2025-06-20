<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/tipo.php");

if (!isset($_GET['id_tipo'])) {
    http_response_code(400);
    echo json_encode([
        "error" => "Falta parámetro id_tipo"
    ]);
    exit;
}

$id_tipo = intval($_GET['id_tipo']);

$controlador = new Tipo();

$tipo = $controlador->retornar_tipo_API($id_tipo);

if ($tipo) {
    echo json_encode($tipo);
} else {
    http_response_code(404);
    echo json_encode([
        "error" => "Tipo no encontrado"
    ]);
}

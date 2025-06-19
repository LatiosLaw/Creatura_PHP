<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo local
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../,,/clases/creatura.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Obtener los parámetros de tipo1 y tipo2
$id_tipo1 = isset($_GET['tipo1']) ? intval($_GET['tipo1']) : 0;
$id_tipo2 = isset($_GET['tipo2']) ? intval($_GET['tipo2']) : 0;

$controlador = new Creatura();
$resultado = $controlador->retornar_calculo_de_tipos_defendiendo_API($id_tipo1, $id_tipo2);

echo json_encode([
    "resultado" => "ok",
    "defensas" => $resultado
]);

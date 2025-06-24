<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");  // Ajustar según dominio permitido
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejo de preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido, use POST"
    ]);
    exit();
}

require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

$input = json_decode(file_get_contents('php://input'), true);

$nombre = $input['nombre_habilidad'] ?? '';
$tipo = $input['tipo'] ?? '';
$categoria = $input['categoria'] ?? '';
$potencia = $input['potencia'] ?? '';
$descripcion = $input['descripcion'] ?? '';
$creador = $input['creador'] ?? '';

// Validaciones básicas
if (empty($nombre) || empty($tipo) || empty($categoria) || !is_numeric($potencia)) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Campos inválidos o incompletos."
    ]);
    exit();
}

$resultado = $controladorCreatura->alta_habilidad($nombre, $tipo, $descripcion, $categoria, $potencia, $creador);

if ($resultado == 1) {
    http_response_code(201); // Created
    echo json_encode([
        "resultado" => "ok",
        "mensaje" => "Habilidad creada con éxito."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Error al crear la habilidad."
    ]);
}

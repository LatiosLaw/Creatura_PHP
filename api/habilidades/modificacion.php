<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");  // Ajusta para tu dominio en producción
header("Access-Control-Allow-Methods: POST, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejo de preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Recomendable usar PUT para modificación pero también puede ser POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido. Use POST o PUT."
    ]);
    exit();
}

// Obtener parámetros id_habilidad y creador desde query string o cuerpo JSON
$id_habilidad = $_GET['id_habilidad'] ?? null;
$creador = $_GET['creador'] ?? null;

if (!$id_habilidad || !$creador) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Parámetros faltantes: id_habilidad y creador son requeridos."
    ]);
    exit();
}

// Obtener datos enviados en JSON o form-urlencoded
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;  // fallback a form data si no viene JSON
}

$nombre = $input['nombre_habilidad'] ?? '';
$tipo = $input['tipo'] ?? '';
$categoria = $input['categoria'] ?? '';
$potencia = $input['potencia'] ?? '';
$descripcion = $input['descripcion'] ?? '';

require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

// Validaciones básicas
if (empty($nombre) || empty($tipo) || empty($categoria) || !is_numeric($potencia)) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Campos inválidos o incompletos."
    ]);
    exit();
}

$exito = $controladorCreatura->modificar_habilidad(
    $id_habilidad,
    $nombre,
    $tipo,
    $descripcion,
    $categoria,
    $potencia,
    $creador
);

if ($exito == 1) {
    http_response_code(200);
    echo json_encode([
        "resultado" => "ok",
        "mensaje" => "Habilidad modificada con éxito."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Error al modificar la habilidad."
    ]);
}

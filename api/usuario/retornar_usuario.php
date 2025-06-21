<?php

// CORS headers para todas las solicitudes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Manejo explícito de preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/usuario.php");
$controladorUsuario = new Usuario();

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

if (!isset($_GET['nickname'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: nombre_creatura y creador"
    ]);
    exit;
}

// Obtener los datos del body (JSON)
$data = json_decode(file_get_contents("php://input"), true);

$nickname = $_GET['nickname'] ?? null;

if (!$nickname) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan datos obligatorios"
    ]);
    exit;
}

// Buscar usuario
$usuario = $controladorUsuario->retornar_usuario_personal_API($nickname);

if (!$usuario) {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Usuario no encontrado"
    ]);
    exit;
}

    // Podés usar solo los datos públicos si querés restringir
    unset($usuario['contraseña']); // No se envía nunca
    echo json_encode([
        "resultado" => "ok",
        "usuario" => $usuario
    ]);
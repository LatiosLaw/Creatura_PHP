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
require_once("../../clases/creatura.php");
require_once("../../clases/tipo.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Validar parámetros
if (!isset($_GET['creador'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: creador"
    ]);
    exit;
}

$creador = urldecode($_GET['creador']);

$controladorUsuario = new Usuario();
$controladorCreatura = new Creatura();
$controladorTipo = new Tipo();

$creaturas = $controladorUsuario->listar_creaturas_de_usuario_API($creador, $controladorTipo, $controladorCreatura);

if ($creaturas) {
    echo json_encode([
        "resultado" => "ok",
        "creaturas" => $creaturas
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Creaturas no encontradas"
    ]);
}

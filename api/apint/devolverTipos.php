<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

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
if (!isset($_GET['tipo1'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: tipo1"
    ]);
    exit;
}

$tipo1 = urldecode($_GET['tipo1']);
$tipo2 = urldecode($_GET['tipo2']);
$controlador = new Creatura();
$controladorTipo = new Tipo();
$devolucion = $controlador->devolverTiposMagia($controladorTipo,$tipo1,$tipo2);

if ($devolucion) {
    echo json_encode([
        "resultado" => "ok",
        "devolucion" => $devolucion
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "devolucion no encontrada"
    ]);
}

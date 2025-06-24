<?php
/*

Espera el mismo llamado que retornarAll_Tipos pero con el parametro "creador" en 
la url, enviando para acá el nickname del usuario.

*/

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

/* ---------- CORS pre-flight ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/tipo.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

/* ----- creador en la URL -------------------------------- */
if (!isset($_GET['creador'])) {
    exitJson(400, 'creador_faltante', 'Falta creador en la URL.');
}
$creador = $_GET['creador'];

$controlador = new Tipo();

$tipos = $controlador->listar_tipos_creador($creador);

header('Content-Type: application/json');
echo json_encode($tipos);
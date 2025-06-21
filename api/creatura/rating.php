<?php
header("Access-Control-Allow-Origin: *"); // O específica tu frontend: http://localhost:4200
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}



$data = json_decode(file_get_contents("php://input"), true);


if (
    !isset($data['id_creatura'], $data['usuario'], $data['puntaje'])
) {
    echo json_encode(["resultado" => "error", "mensaje" => "Faltan campos obligatorios"]);
    exit;
}
$id_creatura = intval($data['id_creatura']);
$usuario     = $data['usuario'];
$puntaje     = intval($data['puntaje']);

$ok  = $controladorCreatura->guardar_o_actualizar_rating($usuario, $id_creatura, $puntaje);
$nose = $controladorCreatura->rating_promedio($id_creatura);
echo json_encode([
    "resultado" => $ok ? "ok" : "error",
    "mensaje" => $ok ? "Rating de la Creatura modificado correctamente." : "Error al modificar el rating de la creatura",
    "id_creatura" => $id_creatura,
	"puntaje"=> $nose
]);
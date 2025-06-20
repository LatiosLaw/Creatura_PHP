<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo durante desarrollo
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/creatura.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id_creatura'])) {
        $controlador = new Creatura();
        $resultado = $controlador->baja_creatura_API((int)$data['id_creatura']);

        echo json_encode([
            "resultado" => $resultado ? "ok" : "error"
        ]);
    } else {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "Falta el parámetro id_creatura"
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
}
?>
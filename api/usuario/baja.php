<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo, restringe en producción
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/usuario.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Leer datos del body (por ejemplo: {"nickname": "usuario123"})
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['nickname'])) {
        $controlador = new Usuario();

        $resultado = $controlador->baja_usuario_API($data['nickname']);

        if ($resultado) {
            echo json_encode([
                "resultado" => "ok",
                "mensaje" => "Usuario eliminado correctamente"
            ]);
        } else {
            echo json_encode([
                "resultado" => "error",
                "mensaje" => "No se pudo eliminar el usuario"
            ]);
        }
    } else {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "Falta el parámetro 'nickname'"
        ]);
    }
} else {
    http_response_code(405); // Método no permitido
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
}

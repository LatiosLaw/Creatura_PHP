<?php
// Cabeceras necesarias para API REST
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejo explícito de preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/usuario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica campos obligatorios
    if (
        isset($data['nickname'], $data['correo'], $data['contraseña'])
    ) {
        // Asignar valor por defecto "" si foto o biografia no existen o están vacíos
        $foto = (isset($data['foto']) && !empty($data['foto'])) ? $data['foto'] : "";
        $biografia = (isset($data['biografia']) && !empty($data['biografia'])) ? $data['biografia'] : "";

        $controlador = new Usuario();

        $resultado = $controlador->alta_usuario_API(
            $data['nickname'],
            $data['correo'],
            $foto,
            $biografia,
            $data['contraseña'],
            "usuario"
        );

        if ($resultado === 1) {
            echo json_encode([
                "resultado" => "ok",
                "mensaje" => "Usuario creado exitosamente"
            ]);
        } else {
            echo json_encode([
                "resultado" => "error",
                "mensaje" => "Ya existe un usuario con ese nickname o correo"
            ]);
        }
    } else {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "Faltan datos obligatorios"
        ]);
    }
} else {
    http_response_code(405); // Método no permitido
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
}
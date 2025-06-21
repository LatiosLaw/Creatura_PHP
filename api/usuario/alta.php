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
        $foto = $data['foto'];
        $biografia = (isset($data['biografia']) && !empty($data['biografia'])) ? $data['biografia'] : "";

        $nombreArchivo = null;

if ($foto && preg_match('/^data:image\/(\w+);base64,/', $foto, $tipoImagen)) {
    $extension = strtolower($tipoImagen[1]) === 'jpeg' ? 'jpg' : $tipoImagen[1];
    $nombreArchivo = uniqid("creatura_") . "." . $extension;
$rutaDestino = __DIR__ . "/../../imagenes/creaturas/" . $nombreArchivo;

    $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $foto));
    if ($imagenBinaria === false || file_put_contents($rutaDestino, $imagenBinaria) === false) {
        echo json_encode(["resultado" => "error", "mensaje" => "Error al procesar la imagen"]);
        exit;
    }
}

        $foto = (isset($data['foto']) && !empty($data['foto'])) ? $data['foto'] : "";

        $controlador = new Usuario();

        $resultado = $controlador->alta_usuario_API(
            $data['nickname'],
            $data['correo'],
            $nombreArchivo,
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
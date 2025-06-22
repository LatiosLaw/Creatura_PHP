<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/usuario.php");
$controladorUsuario = new Usuario();

// Leer JSON desde Angular
$input = json_decode(file_get_contents("php://input"), true);

$nickname = $input['nickname'] ?? null;
$correo = $input['correo'] ?? null;
$biografia = $input['biografia'] ?? '';
$contra = $input['contraseña'] ?? '';
$foto_base64 = $input['foto'] ?? null;

if (!$nickname || !$correo) {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan datos requeridos"
    ]);
    exit;
}

$usuario_viejo = $controladorUsuario->retornar_usuario_personal($nickname);
if (!$usuario_viejo) {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Usuario no encontrado"
    ]);
    exit;
}

// Verificar disponibilidad (puedes adaptar esta lógica si no aplica)
if ($controladorUsuario->verificar_disponibilidad($nickname, $correo, $nickname, $correo) != 1) {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Correo ya en uso"
    ]);
    exit;
}

if (empty($contra)) {
    $contra = $usuario_viejo['contraseña'];
}

// Manejo de imagen base64
$nombreArchivo = $usuario_viejo['foto'];
if ($foto_base64 && strpos($foto_base64, 'data:image') === 0) {
    $ext = strpos($foto_base64, 'image/png') !== false ? 'png' : 'jpg';
    $nombreArchivo = $nickname . '_' . uniqid() . '.' . $ext;
    $base64Data = explode(',', $foto_base64)[1];

    $ruta = __DIR__ . "/../../imagenes/usuarios/" . $nombreArchivo;
    if (!file_put_contents($ruta, base64_decode($base64Data))) {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "No se pudo guardar la imagen"
        ]);
        exit;
    }
}

$tipo = $usuario_viejo['tipo'];

$resultado = $controladorUsuario->modificar_usuario(
    $nickname,
    $correo,
    $nombreArchivo,
    $biografia,
    $contra,
    $tipo
);

if ($resultado == 1) {
    echo json_encode([
        "resultado" => "ok",
        "mensaje" => "Usuario modificado exitosamente"
    ]);
} else {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "No se pudo modificar el usuario"
    ]);
}
?>

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
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["resultado" => "error", "mensaje" => "Método no permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$camposObligatorios = [
    'nombre_creatura', 'id_tipo1', 'id_tipo2', 'descripcion',
    'hp', 'atk', 'def', 'spa', 'sdef', 'spe',
    'creador', 'publico', 'imagen'
];

foreach ($camposObligatorios as $campo) {
    if (!isset($data[$campo])) {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "Falta el campo obligatorio: $campo"
        ]);
        exit;
    }
}

// Cargar campos principales
$nombre     = $data['nombre_creatura'];
$tipo1      = $data['id_tipo1'] ?: 0;
$tipo2      = $data['id_tipo2'] ?: 0;
$descripcion= $data['descripcion'];
$hp         = $data['hp'] ?: 70;
$atk        = $data['atk'] ?: 70;
$def        = $data['def'] ?: 70;
$spa        = $data['spa'] ?: 70;
$sdef       = $data['sdef'] ?: 70;
$spe        = $data['spe'] ?: 70;
$creador    = $data['creador'];
$publico    = $data['publico'] ?: 0;

$habilidades = isset($data['habilidades']) ? $data['habilidades'] : [];
$imagenBase64 = $data['imagen'];
$nombreArchivo = null;

// Procesar imagen (formato base64)
if ($imagenBase64 && preg_match('/^data:image\/(\w+);base64,/', $imagenBase64, $tipoImagen)) {
    $extension = strtolower($tipoImagen[1]) === 'jpeg' ? 'jpg' : $tipoImagen[1];
    $nombreArchivo = uniqid("creatura_") . "." . $extension;
$rutaDestino = __DIR__ . "/../../imagenes/creaturas/" . $nombreArchivo;

    $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
    if ($imagenBinaria === false || file_put_contents($rutaDestino, $imagenBinaria) === false) {
        echo json_encode(["resultado" => "error", "mensaje" => "Error al procesar la imagen"]);
        exit;
    }
}

// Alta en la base de datos
$id_creatura_nueva = $controladorCreatura->alta_creatura_API(
    $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def,
    $spa, $sdef, $spe, $creador, $nombreArchivo, $publico
);

// Guardar habilidades
if ($id_creatura_nueva && is_array($habilidades)) {
    foreach ($habilidades as $hab) {
        if (isset($hab['id_habilidad'])) {
            $controladorCreatura->alta_moveset_API($id_creatura_nueva, $hab['id_habilidad']);
        }
    }
}

echo json_encode([
    "resultado" => $id_creatura_nueva ? "ok" : "error",
    "id_creatura" => $id_creatura_nueva,
    "mensaje" => $id_creatura_nueva ? "Creatura registrada correctamente." : "Error al registrar la creatura"
]);

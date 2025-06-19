<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Solo para desarrollo
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["resultado" => "error", "mensaje" => "Método no permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['id_creatura'], $data['nombre_creatura'], $data['id_tipo1'], $data['id_tipo2'],
    $data['descripcion'], $data['hp'], $data['atk'], $data['def'], $data['spa'], $data['sdef'], $data['spe'],
    $data['creador'], $data['publico'])
) {
    echo json_encode(["resultado" => "error", "mensaje" => "Faltan campos obligatorios"]);
    exit;
}

$id_creatura = intval($data['id_creatura']);
$nombre      = $data['nombre_creatura'];
$tipo1       = intval($data['id_tipo1']);
$tipo2       = intval($data['id_tipo2']);
$descripcion = $data['descripcion'];
$hp          = intval($data['hp']);
$atk         = intval($data['atk']);
$def         = intval($data['def']);
$spa         = intval($data['spa']);
$sdef        = intval($data['sdef']);
$spe         = intval($data['spe']);
$creador     = $data['creador'];
$publico     = intval($data['publico']);

$habilidades = isset($data['habilidades']) ? $data['habilidades'] : [];

$creatura_vieja = $controladorCreatura->retornar_creatura_API($nombre, $creador);
$imagenAnterior = $creatura_vieja['imagen'];

$nombreArchivo = $imagenAnterior;

// Procesar imagen si se envía una nueva (en base64)
if (!empty($data['imagen']) && preg_match('/^data:image\/(\w+);base64,/', $data['imagen'], $tipoImagen)) {
    $extension = strtolower($tipoImagen[1]) === 'jpeg' ? 'jpg' : $tipoImagen[1];
    $nombreArchivo = uniqid("creatura_") . "." . $extension;
    $rutaDestino = "../imagenes/creaturas/" . $nombreArchivo;

    $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['imagen']));
    if ($imagenBinaria === false || file_put_contents($rutaDestino, $imagenBinaria) === false) {
        echo json_encode(["resultado" => "error", "mensaje" => "Error al procesar la imagen"]);
        exit;
    }
}

// Borrar moveset anterior
$controladorCreatura->borrar_moveset_por_creatura_API($id_creatura);

// Modificar creatura
$ok = $controladorCreatura->modificar_creatura_API(
    $id_creatura, $nombre, $tipo1, $tipo2, $descripcion, $hp, $atk, $def,
    $spa, $sdef, $spe, $creador, $nombreArchivo, $publico
);

// Insertar nuevas habilidades
foreach ($habilidades as $hab) {
    if (isset($hab['id'])) {
        $controladorCreatura->alta_moveset_API($id_creatura, $hab['id']);
    }
}

echo json_encode([
    "resultado" => $ok ? "ok" : "error",
    "mensaje" => $ok ? "Creatura modificada correctamente." : "Error al modificar creatura",
    "id_creatura" => $id_creatura
]);

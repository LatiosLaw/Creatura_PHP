<?php

/*

Espera un POST con los siguientes datos : 

Ejemplo : 

{
  "id_tipo" : 29                                         // ID del tipo a modificar
  "nombre_original": "Gualberto",                        // Nombre Original del tipo a modificar (input hidden)
  "nombre": "Jose",                                      // Nombre modificado del tipo
  "color_hex": "FF5733",                                 // Color hexadecimal sin el #
  "self_int": 1,                                         // interaccion consigo mismo
  "icono_base64": "data:image/png;base64,iVBORw0K...",   // enviar la imagen como base64 (Ver alta de
                                                         // creatura o registro RIA para un ejemplo), este
                                                         // campo es opcional y en caso de estar vacio
                                                         // se pone ""
  "creador": "Gualberto",                                // Nickname del creador del tipo, sacado de localStorage
  "debilidades":   [2, 4],                               // IDs de tipos a los que es débil   (x2)
  "resistencias":  [3],                                  // IDs de tipos que resiste          (x0.5)
  "inmunidades":   [5]                                   // IDs de tipos que no le afectan    (x0)
}
*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

/* ---------- CORS pre-flight ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

/* ---------- Verificar id_tipo en la URL ---------- */
if (!isset($input['id_tipo'])) {
    exitJson(400, 'mod_tipo_id_faltante', 'Falta id_tipo en la URL.');
}
$id_tipo = (int) $input['id_tipo'];

/* ---------- Dependencias ---------- */
require_once("../../clases/tipo.php");
$controladorTipo = new Tipo();

/* ---------- Leer JSON ---------- */
if ($input === null) {
    exitJson(400, 'json_invalido', 'El cuerpo de la solicitud no es JSON válido.');
}

/* ---------- Campos del payload ---------- */
$nombre_original = $input['nombre_original'] ?? '';
$nombre          = $input['nombre']          ?? '';
$color_hex       = strtoupper(ltrim(($input['color_hex'] ?? ''), '#'));
$icono_base64    = $input['icono_base64'] ?? null;        // opcional

$debilidades  = $input['debilidades']  ?? [];
$resistencias = $input['resistencias'] ?? [];
$inmunidades  = $input['inmunidades']  ?? [];

/* ---------- Validaciones mínimas ---------- */
if ($nombre_original === '' || $nombre === '' || !preg_match('/^[A-F0-9]{6}$/', $color_hex)) {
    exitJson(400, 'mod_tipo_campos_vacios', 'Campos obligatorios vacíos o color inválido.');
}

/* ---------- Verificar que el tipo exista ---------- */
$tipo_viejo = $controladorTipo->retornar_tipo($id_tipo);
if (!$tipo_viejo) {
    exitJson(404, 'tipo_no_encontrado', 'Tipo no encontrado.');
}

/* ---------- Procesar ícono base64 (opcional) ---------- */
$nombreIcono = $tipo_viejo['icono'];

if (!empty($icono_base64) && strpos($icono_base64, 'data:image') === 0) {
    // 1. Validar tipo
    $ext = null;
    if (strpos($icono_base64, 'image/png') !== false) {
        $ext = 'png';
    } elseif (strpos($icono_base64, 'image/jpeg') !== false) {
        $ext = 'jpg';
    }

    if ($ext === null) {
        exitJson(400, 'icono_tipo_no_valido', 'El ícono debe ser PNG o JPEG.');
    }

    // 2. Guardar nuevo archivo
    $nombreIcono = uniqid('tipo_') . '.' . $ext;
    $destino = $_SERVER['DOCUMENT_ROOT'] . "/Creatura_PHP/imagenes/tipos/" . $nombreIcono;
    $base64Data = explode(',', $icono_base64, 2)[1] ?? '';

    $ok = @file_put_contents($destino, base64_decode($base64Data));
    if ($ok === false) {
        exitJson(500, 'fallo_subida_icono', 'No se pudo guardar el ícono.');
    }
}

/* ---------- Actualizar datos del tipo ---------- */
$exito_mod = $controladorTipo->modificar_tipo(
    $nombre_original,
    $nombre,
    $color_hex,
    $nombreIcono,
    $tipo_viejo['creador']   // se mantiene el creador
);
if (!$exito_mod) {
    exitJson(500, 'fallo_modificacion_tipo', 'No se pudo modificar el tipo.');
}

/* ---------- Actualizar efectividades ---------- */
if (!$controladorTipo->eliminar_efectividades($id_tipo)) {
    exitJson(500, 'fallo_eliminar_efectividades', 'No se pudieron eliminar efectividades antiguas.');
}

foreach ($resistencias as $resis)  { $controladorTipo->alta_efectividad($resis,  $id_tipo, 0.5); }
foreach ($debilidades as $deb)    { $controladorTipo->alta_efectividad($deb,   $id_tipo, 2);   }
foreach ($inmunidades as $inmu)   { $controladorTipo->alta_efectividad($inmu,  $id_tipo, 0);   }

/* ---------- Respuesta OK ---------- */
echo json_encode([
    "resultado" => "ok",
    "mensaje"   => "Tipo modificado correctamente.",
    "tipo"      => [
        "id_tipo"   => $id_tipo,
        "nombre"    => $nombre,
        "color_hex" => $color_hex,
        "icono"     => $nombreIcono,
        "creador"   => $tipo_viejo['creador']
    ]
]);
exit;

/* ---------- Función auxiliar ---------- */
function exitJson(int $httpCode, string $codigo, string $mensaje): void {
    http_response_code($httpCode);
    echo json_encode([
        "resultado" => "error",
        "codigo"    => $codigo,
        "mensaje"   => $mensaje
    ]);
    exit;
}

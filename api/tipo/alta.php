<?php 

/*

Espera un POST con los siguientes datos : 

Ejemplo : 

{
  "nombre": "Fuego",
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
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// ---------- Pre-flight CORS ---------- //
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ---------- Dependencias ---------- //
require_once("../../clases/tipo.php");
$controladorTipo = new Tipo();

// ---------- Leer y validar JSON ---------- //
$input = json_decode(file_get_contents("php://input"), true);
if ($input === null) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "codigo"    => "json_invalido",
        "mensaje"   => "El cuerpo de la solicitud no es JSON válido."
    ]);
    exit;
}

// Campos
$nombre       = $input['nombre'] ?? '';
$color_hex    = strtoupper(ltrim(($input['color_hex'] ?? ''), '#'));
$self_int     = (float)($input['self_int']  ?? 1);
$icono_base64 = $input['icono_base64']      ?? null;
$creador      = $input['creador'] ?? '';

$debilidades  = $input['debilidades']  ?? [];
$resistencias = $input['resistencias'] ?? [];
$inmunidades  = $input['inmunidades']  ?? [];

// --- Validaciones mínimas ---
if ($nombre === '') {
    errorJson("alta_tipo_nombre_vacio", "El nombre del tipo es obligatorio.");
}
if (!preg_match('/^[A-F0-9]{6}$/', $color_hex)) {
    errorJson("alta_tipo_color_invalido", "El campo color_hex debe ser un código HEX de 6 dígitos.");
}
if (!in_array($self_int, [0, 0.5, 1, 2])) {
    errorJson("alta_tipo_self_int_invalido", "El valor self_int debe ser 0, 0.5, 1 o 2.");
}

// --- Procesar icono (opcional) ---
$nombreArchivo = "";  // <-- inicializamos vacío
if ($icono_base64 && strpos($icono_base64, 'data:image') === 0) {
    // detectar extensión
    $ext = (strpos($icono_base64, 'image/png') !== false) ? 'png' :
           ((strpos($icono_base64, 'image/jpeg') !== false) ? 'jpg' : null);

    if (!$ext) {
        errorJson("alta_tipo_icono_no_valido", "El ícono debe ser PNG o JPEG.");
    }

    $nombreArchivo = uniqid('tipo_') . ".$ext";
    $rutaDestino = $_SERVER['DOCUMENT_ROOT'] . "/Creatura_PHP/imagenes/tipos/" . $nombreArchivo;
    $base64data    = explode(',', $icono_base64)[1];

    if (@file_put_contents($rutaDestino, base64_decode($base64data)) === false) {
        errorJson("alta_tipo_fallo_subida_imagen", "No se pudo guardar la imagen del tipo.");
    }
}

// ---------- Alta de tipo ----------
$altaOk = $controladorTipo->alta_tipo($nombre, $color_hex, $nombreArchivo, $creador);
if ($altaOk != 1) {
    errorJson("fallo_alta_tipo", "No se pudo insertar el tipo en la base de datos.");
}

// Obtener id recién creado
$tipo_creado = $controladorTipo->retornar_tipo_por_creador($nombre, $creador);
$id_tipo     = $tipo_creado['id_tipo'] ?? null;
if (!$id_tipo) {
    errorJson("fallo_recuperar_tipo", "Error al recuperar el tipo recién creado.");
}

// ---------- Registrar efectividades ----------
foreach ($resistencias as $idRes)  { $controladorTipo->alta_efectividad($idRes,  $id_tipo, 0.5); }
foreach ($debilidades as $idDeb)   { $controladorTipo->alta_efectividad($idDeb,  $id_tipo, 2);   }
foreach ($inmunidades as $idInmu)  { $controladorTipo->alta_efectividad($idInmu, $id_tipo, 0);   }
if ($self_int != 1) {
    $controladorTipo->alta_efectividad($id_tipo, $id_tipo, $self_int);
}

// ---------- Respuesta final ----------
echo json_encode([
    "resultado" => "ok",
    "mensaje"   => "Tipo creado correctamente.",
    "tipo"      => [
        "id_tipo"   => $id_tipo,
        "nombre"    => $nombre,
        "color_hex" => $color_hex,
        "icono"     => $nombreArchivo,
        "creador"   => $creador,
        "self_int"  => $self_int
    ]
]);
exit;

/*===============================================================
 *  Función auxiliar para responder con error y código HTTP 400
 *===============================================================*/
function errorJson(string $code, string $msg): void {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "codigo"    => $code,
        "mensaje"   => $msg
    ]);
    exit;
}
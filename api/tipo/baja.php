<?php
/*

Espera un DELETE, con la id del tipo por url (Ver eliminar creatura RIA si existe duda alguna)

*/


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

/* ----- Pre-flight CORS  ---------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/* ----- Solo aceptamos DELETE ----------------------------- */
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    exitJson(405, 'metodo_no_permitido', 'Método HTTP no permitido (use DELETE).');
}

/* ----- id_tipo en la URL -------------------------------- */
if (!isset($_GET['id_tipo'])) {
    exitJson(400, 'id_tipo_faltante', 'Falta id_tipo en la URL.');
}
$id_tipo = (int)$_GET['id_tipo'];

/* ----- Dependencias ------------------------------------- */
require_once("../../clases/tipo.php");
require_once("../../clases/creatura.php");

$ctlTipo     = new Tipo();
$ctlCreatura = new Creatura();

/* ----- Verificar existencia del tipo -------------------- */
$tipo = $ctlTipo->retornar_tipo($id_tipo);
if (!$tipo) {
    exitJson(404, 'tipo_no_encontrado', 'Tipo no encontrado.');
}

/* =========================================================
 *  1)  Eliminar habilidades ligadas a este tipo
 * =======================================================*/
$habilidades = $ctlTipo->retornar_habilidades_tipo($id_tipo);
if (is_array($habilidades)) {
    foreach ($habilidades as $hab) {
        if (isset($hab['id_habilidad']) && !$ctlCreatura->baja_habilidad($hab['id_habilidad'])) {
            exitJson(500, 'fallo_eliminar_habilidades', 'No se pudieron eliminar habilidades asociadas.');
        }
    }
}

/* =========================================================
 *  2)  Ajustar criaturas que usan este tipo
 * =======================================================*/
$criaturas = $ctlTipo->retornar_creaturas_tipo($id_tipo);
while ($criaturas && ($row = mysqli_fetch_assoc($criaturas))) {

    $nuevoTipo1 = ($row['id_tipo1'] == $id_tipo) ? $row['id_tipo2'] : $row['id_tipo1'];
    /*  El segundo tipo se vuelve 0 (sin tipo) */
    $ok = $ctlCreatura->modificar_creatura(
        $row['id_creatura'], $row['nombre_creatura'],
        $nuevoTipo1, 0,
        $row['descripcion'],
        $row['hp'], $row['atk'], $row['def'],
        $row['spa'], $row['sdef'], $row['spe'],
        $row['creador'], $row['imagen'],
        $row['publico']
    );

    if (!$ok) {
        exitJson(500, 'fallo_modificar_criaturas', 'No se pudieron actualizar criaturas afectadas.');
    }
}

/* =========================================================
 *  3)  Eliminar efectividades y el tipo en sí
 * =======================================================*/
if (!$ctlTipo->eliminar_efectividades($id_tipo)) {
    exitJson(500, 'fallo_eliminar_efectividades', 'No se pudieron eliminar las efectividades.');
}

if (!$ctlTipo->baja_tipo($id_tipo)) {
    exitJson(500, 'fallo_eliminar_tipo', 'No se pudo eliminar el tipo.');
}

/* ---------- ÉXITO ABSOLUTO ------------------------------ */
echo json_encode([
    "resultado" => "ok",
    "mensaje"   => "Tipo eliminado correctamente.",
    "id_tipo"   => $id_tipo
]);
exit;


/* =========================================================
 *  Función auxiliar para responder errores en JSON
 * =======================================================*/
function exitJson(int $httpCode, string $codigo, string $mensaje): void {
    http_response_code($httpCode);
    echo json_encode([
        "resultado" => "error",
        "codigo"    => $codigo,
        "mensaje"   => $mensaje
    ]);
    exit;
}

<?php
// CORS headers para todas las solicitudes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Manejo explícito de preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../../clases/creatura.php");
$controladorCreatura= new Creatura();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

// Validar parámetros
if (!isset($_GET['buscar'])) {
    http_response_code(400);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Faltan parámetros: creador"
    ]);
    exit;
}
$buscar = urldecode($_GET['buscar']);

$tipo_buscado = $controladorTipo->retornar_tipo_por_creador($buscar, "SYSTEM");

if($tipo_buscado['id_tipo']!=0){
$creaturas_de_un_tipo = $controladorTipo->retornar_creaturas_tipo2($tipo_buscado['id_tipo'],$controladorCreatura);
}else{
$creaturas_de_un_tipo = null;
}

$creaturas_default_encontradas = $controladorCreatura->buscar_creaturas_default2($buscar,$controladorTipo);
$creaturas_usuarios_encontradas = $controladorCreatura->buscar_creaturas2($buscar,$controladorTipo);
$usuarios_encontrados = $controladorUsuario->listar_usuarios_busqueda2($buscar);

if ($creaturas_default_encontradas ||$creaturas_usuarios_encontradas ||$usuarios_encontrados || $creaturas_de_un_tipo) {
    echo json_encode([
        "resultado" => "ok",
        "creaturas" => $creaturas_default_encontradas,
		"creaturasUsr" => $creaturas_usuarios_encontradas,
		"creaturasTipo" => $creaturas_de_un_tipo,
		"usuarios" => $usuarios_encontrados,
		"jajaauto autobus" => $buscar
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "No se encontro nada, lmao",
        "creaturas" => $creaturas_default_encontradas,
		"creaturasUsr" => $creaturas_usuarios_encontradas,
		"creaturasTipo" => $creaturas_de_un_tipo,
		"usuarios" => $usuarios_encontrados
    ]);
}

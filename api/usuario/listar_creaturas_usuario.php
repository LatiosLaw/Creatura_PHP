<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Para desarrollo
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../clases/usuario.php");
require_once("../../clases/tipo.php");

// Se puede recibir por GET o POST (JSON)
$nickname = null;

// Soporte para GET
if (isset($_GET['nickname'])) {
    $nickname = $_GET['nickname'];
}

// Soporte para POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['nickname'])) {
        $nickname = $input['nickname'];
    }
}

// Validar
if (!$nickname) {
    echo json_encode([
        "resultado" => "error",
        "mensaje" => "Falta el parámetro 'nickname'"
    ]);
    exit;
}

// Instanciar controladores
$controladorUsuario = new Usuario();
$controladorTipo = new Tipo();

// Obtener criaturas
$creaturas = $controladorUsuario->listar_creaturas_de_usuario_API($nickname, $controladorTipo);

// Devolver respuesta
echo json_encode([
    "resultado" => "ok",
    "creaturas" => $creaturas
]);

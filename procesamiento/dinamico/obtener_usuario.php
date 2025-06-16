<?php
header('Content-Type: application/json');
include_once("../../clases/tipo.php");
include_once("../../clases/creatura.php");
include_once("../../clases/usuario.php");

if (!isset($_GET['nickname'])) {
    echo json_encode(['error' => 'Falta el nickname']);
    exit;
}

$nickname = $_GET['nickname'];

$controladorUsuario = new Usuario();

$usuario = $controladorUsuario->retornar_usuario_personal($nickname);

include_once("../../clases/tipo.php");
$controladorTipo = new Tipo();
$creaturas = $controladorUsuario->listar_creaturas_de_usuario($nickname, $controladorTipo); // usa función con info de tipos

echo json_encode([
    'usuario' => $usuario,
    'creaturas' => $creaturas
]);

?>
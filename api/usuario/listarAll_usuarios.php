<?php
// Headers para permitir CORS y decir que se devuelve JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once("../../clases/usuario.php");

// Crear instancia del controlador
$controladorUsuario = new Usuario();
require_once("../../clases/tipo.php");

// Obtener la lista de creaturas con tipos
$lista_usuarios = $controladorUsuario->listar_usuarios_api();

// Devolver la lista en formato JSON
echo json_encode($lista_usuarios);

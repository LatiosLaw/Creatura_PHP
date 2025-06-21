<?php
// Headers para permitir CORS y decir que se devuelve JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once("../../clases/creatura.php");

// Crear instancia del controlador
$controlador = new Creatura();
require_once("../../clases/tipo.php");
$controladorTipo = new Tipo();

// Obtener la lista de creaturas con tipos
$lista_creaturas = $controlador->listar_creaturas_con_tipos_API($controladorTipo);

// Devolver la lista en formato JSON
echo json_encode($lista_creaturas);

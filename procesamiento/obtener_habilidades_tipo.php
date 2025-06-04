<?php
include_once("../clases/conexion.php");
include_once("../clases/tipo.php");

$conexion = (new Conexion())->conectar();
$controladorTipo = new Tipo();

$id_tipo = $_GET['id_tipo'] ?? 0;
$habilidades = $controladorTipo->retornar_habilidades_tipo($id_tipo, $conexion);

header('Content-Type: application/json');
echo json_encode($habilidades);
?>

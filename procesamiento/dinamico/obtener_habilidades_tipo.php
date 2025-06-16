<?php
include_once("../../clases/tipo.php");

$controladorTipo = new Tipo();

$id_tipo = $_GET['id_tipo'] ?? 0;
$habilidades = $controladorTipo->retornar_habilidades_tipo($id_tipo);

header('Content-Type: application/json');
echo json_encode($habilidades);
?>

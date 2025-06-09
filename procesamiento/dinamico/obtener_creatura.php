<?php
header('Content-Type: application/json');
include_once("../../clases/conexion.php");
include_once("../../clases/creatura.php");

if (!isset($_GET['nombre']) || !isset($_GET['creador'])) {
    echo json_encode(['error' => 'Faltan parámetros']);
    exit;
}

$nombre = $_GET['nombre'];
$creador = $_GET['creador'];

$conexion = (new Conexion())->conectar();
$controladorCreatura = new Creatura();

$creatura = $controladorCreatura->retornar_creatura($nombre, $creador, $conexion);
$habilidades = $controladorCreatura->retornar_habilidades($creatura['id_creatura'], $conexion);
$tipos = $controladorCreatura->retornar_tipos_de_creatura($creatura['id_creatura'], $conexion);
$id_tipo1 = $tipos['tipo1']['id_tipo'] ?? 0;
$id_tipo2 = $tipos['tipo2']['id_tipo'] ?? 0;

$interacciones = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($id_tipo1, $id_tipo2, $conexion);


echo json_encode([
    'creatura' => $creatura,
    'habilidades' => $habilidades,
    'tipos' => $tipos,
    'interacciones' => $interacciones
]);
?>
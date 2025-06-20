<?php

require_once("clases/tipo.php");
$controladorTipo= new Tipo();

require_once("clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_SESSION['nickname'])) {
    $nickname_sesion = $_SESSION['nickname'];
}

if (isset($_GET['tipo'])) {
$id_tipo = $_GET['tipo'];

$tipo = $controladorTipo->retornar_tipo($id_tipo);
$nombre_tipo = $tipo['nombre_tipo'];
$color = $tipo['color'];
$icono = $tipo['icono'];
$creador = $tipo['creador'];

echo "('$nombre_tipo', '$color', '$icono', '$creador')" . "<br>";

echo "Efectividades : " . "<br>";

$efectividades = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($id, 0);

foreach ($efectividades as $tipo_interact) {
$multi = $tipo_interact['multiplicador'];
    if($multi != 1 ){
$atacante = $tipo_interact['id_tipo'];

    echo "($atacante, $id, $multi)". "<br>";
    }
    
    }

}

if (isset($_GET['creatura']) && isset($_GET['creador'])) {
$nombre_creatura = $_GET['creatura'];
$creador = $_GET['creador'];

$info_creatura = $controladorCreatura->retornar_creatura($nombre_creatura, $creador);

$habilidades = $controladorCreatura->retornar_habilidades($info_creatura['id_creatura']);

$nombre_c = $info_creatura['nombre_creatura'];
$id_tipo1 = $info_creatura['id_tipo1'];
$id_tipo2 = $info_creatura['id_tipo2'];
$descripcion = $info_creatura['descripcion'];
$hp = $info_creatura['hp'];
$atk = $info_creatura['atk'];
$def = $info_creatura['def'];
$spa = $info_creatura['spa'];
$sdef = $info_creatura['sdef'];
$spe = $info_creatura['spe'];
$creador_creatura = $info_creatura['creador'];
$imagen = $info_creatura['imagen'];
$publico = $info_creatura['publico'];

echo "Informacion de la creatura : " . "<br>";
echo "('$nombre_c', $id_tipo1, $id_tipo2, '$descripcion', $hp, $atk, $def, $spa, $sdef, $spe, '$creador', '$imagen', $publico)";

echo "<br>" . "Informacion del moveset : " . "<br>";

foreach ($habilidades as $moveset){

    $id_creatura_hab = $info_creatura['id_creatura'];
    $id_hab = $moveset['id_habilidad'];

    echo "($id_creatura_hab, $id_hab)," . "<br>";

}

}

?>
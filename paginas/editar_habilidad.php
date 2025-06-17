<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['nombre_habilidad']) && isset($_GET['creador'])) {
    $nombre_habilidad = urldecode($_GET['nombre_habilidad']);
    $creador_cretura = urldecode($_GET['creador']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habilidad - <?php echo $nombre_habilidad ?></title>
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>
    <button onclick="window.location.href = document.referrer || '/Creatura_PHP/index.php';">Volver</button>
<?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
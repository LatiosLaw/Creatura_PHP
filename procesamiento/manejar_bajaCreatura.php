<?php

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['id_creatura'])) {
    $id_creatura = urldecode($_GET['id_creatura']);
}

 echo "Elimininando creatura : " . "<br>";
$controladorCreatura->baja_creatura($id_creatura);

echo "ELIMINAR DE CREATURA EXITOSO! Redirigiendo...";
header("refresh:3; url=/Creatura_PHP/paginas/gestor_creatura.php");
?>
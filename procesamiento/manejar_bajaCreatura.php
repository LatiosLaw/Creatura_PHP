<?php

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_GET['id_creatura'])) {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=eliminar_creatura_id_invalido");
    exit();
}

$id_creatura = urldecode($_GET['id_creatura']);

// Intentar eliminar
$exito = $controladorCreatura->baja_creatura($id_creatura);

if ($exito) {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?success=eliminar_creatura_exitosa");
} else {
    header("Location: /Creatura_PHP/paginas/gestor_creatura.php?error=eliminar_creatura_fallo");
}
exit();

<?php

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_GET['id_habilidad'])) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=eliminar_habilidad_id_invalido");
    exit();
}

$id_habilidad = urldecode($_GET['id_habilidad']);

$resultado = $controladorCreatura->baja_habilidad($id_habilidad);

if ($resultado) {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?success=eliminar_habilidad_exitosa");
} else {
    header("Location: /Creatura_PHP/paginas/gestor_habilidad.php?error=eliminar_habilidad_fallo");
}
exit();

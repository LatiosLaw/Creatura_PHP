<?php

$busqueda = $_POST['campo_busqueda'];

//SIKE! Esto no busca nada.

header("Location: /Creatura_PHP/paginas/resultados_buscador.php?parametro=" . urlencode($busqueda));
exit;
?>
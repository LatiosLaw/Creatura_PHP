<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

$lista_usuarios = $controladorUsuario->listar_usuarios_creadores();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\todos_los_usuarios.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>

<?php include_once("../piezas_html/cabecera.php"); ?>
<?php include_once("../piezas_html/popup_adaptativo.php"); ?>
<div class="cont-titular"> 
    <div class="titular">
        <div>Otros Creadores de Creaturas</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>
<div class="contenedor-usuarios">
    <?php while ($fila = mysqli_fetch_assoc($lista_usuarios)) : ?>
    <div class="contenido-usuario">
        <a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($fila['nickname']) ?>">
            <div class="imagen-usuario">
                <img src="/Creatura_PHP/imagenes/usuarios/<?= htmlspecialchars($fila['foto']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            </div>
            <div class="nombre-usuario">
                <?= htmlspecialchars($fila['nickname']) ?>
            </div>
        </a>
    </div>
    <?php endwhile; ?>
</div>

<?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
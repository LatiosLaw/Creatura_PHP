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
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

<div>
    <button onclick="location.href='/Creatura_PHP/index.php'">volver</button>
    
        <h2>Otros Creadores de Creaturas</h2>
 <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($lista_usuarios)) : ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($fila['nickname']) ?>"><?= htmlspecialchars($fila['nickname']) ?></a></td>
                        <td><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($fila['nickname']) ?>"><img src="/Creatura_PHP/imagenes/usuarios/<?= htmlspecialchars($fila['foto']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>    

            <?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
<?php

require_once("./clases/creatura.php");
require_once("./clases/tipo.php");
require_once("./clases/usuario.php");
$controladorCreatura = new Creatura();
$controladorTipo = new Tipo();
$controladorUsuario = new Usuario();

$lista_creaturas = $controladorCreatura->listar_creaturas_ext(15, "SYSTEM");
$usuarios_aleatorios = $controladorUsuario->listar_usuarios_aleatorios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creatura</title>
</head>

<body>

    <?php include_once("./piezas_html/cabecera.php"); ?>

    <a href="./index2.php"><button>Index 2</button></a>

    <div>
        <h2>CREATURAS</h2>
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo 1</th>
                    <th>Tipo 2</th>
                    <th>Rating</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($lista_creaturas)) :

                    $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
                    $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])

                ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM"><?= htmlspecialchars($fila['nombre_creatura']) ?></a></td>
                        <td>
                            <?php if ($fila['id_tipo1'] != 0): ?>
                                <div style="background-color: #<?= $tipo1['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo1['nombre_tipo']; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($fila['id_tipo2'] != 0): ?>
                                <div style="background-color: #<?= $tipo2['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo2['nombre_tipo']; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5</td>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="location.href='/Creatura_PHP/paginas/todas_las_creaturas.php'">Ver mas</button>
    </div>

    <div>
        <h2>Algunos Usuarios</h2>
 <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($usuarios_aleatorios)) : ?>
                    <tr>
                                                <td><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($fila['nickname']) ?>"><?= htmlspecialchars($fila['nickname']) ?></a></td>
                        <td><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($fila['nickname']) ?>"><img src="/Creatura_PHP/imagenes/usuarios/<?= htmlspecialchars($fila['foto']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="location.href='/Creatura_PHP/paginas/todos_los_usuarios.php'">Ver mas</button>
    </div>

    <?php include_once("./piezas_html/pie_pagina.php"); ?>
</body>

</html>
<?php

require_once("../clases/creatura.php");
require_once("../clases/tipo.php");
$controladorCreatura = new Creatura();
$controladorTipo = new Tipo();

$lista_creaturas_default = $controladorCreatura->listar_creaturas_ext(100, "SYSTEM");
$lista_creaturas_usuarios = $controladorCreatura->listar_creaturas_usuarios_aleatorios();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Creaturas</title>
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

    <button onclick="location.href='/Creatura_PHP/index.php'">volver</button>
    <div>
        <h2>Creaturas del Sistema</h2>
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
                <?php while ($fila = mysqli_fetch_assoc($lista_creaturas_default)) :

                    $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
                    $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])

                ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM"><?= htmlspecialchars($fila['nombre_creatura']) ?></a></td>
                        <td>
                            <?php if ($fila['id_tipo1'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador']) ?>&id_tipo=<?= urlencode($tipo1['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo1['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo1['nombre_tipo']; ?>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($fila['id_tipo2'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador']) ?>&id_tipo=<?= urlencode($tipo2['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo2['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo2['nombre_tipo']; ?>
                                </div>
                                 </a>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5</td>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div>
        <h2>Algunas Creaturas de Otros Usuarios</h2>
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
                <?php while ($fila = mysqli_fetch_assoc($lista_creaturas_usuarios) ) :

                    $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
                    $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])

                ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><?= htmlspecialchars($fila['nombre_creatura']) ?></a></td>
                        <td>
                            <?php if ($fila['id_tipo1'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador']) ?>&id_tipo=<?= urlencode($tipo1['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo1['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo1['nombre_tipo']; ?>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($fila['id_tipo2'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador']) ?>&id_tipo=<?= urlencode($tipo2['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo2['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo2['nombre_tipo']; ?>
                                </div>
                                 </a>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5</td>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
        <?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
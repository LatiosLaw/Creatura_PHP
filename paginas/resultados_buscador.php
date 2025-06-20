<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['parametro'])) {
    $parametro_busqueda = urldecode($_GET['parametro']);
}

$tipo_buscado = $controladorTipo->retornar_tipo_por_creador($parametro_busqueda, "SYSTEM");

if($tipo_buscado['id_tipo']!=0){
$creaturas_de_un_tipo = $controladorTipo->retornar_creaturas_tipo($tipo_buscado['id_tipo']);
}

$creaturas_default_encontradas = $controladorCreatura->buscar_creaturas_default($parametro_busqueda);
$creaturas_usuarios_encontradas = $controladorCreatura->buscar_creaturas($parametro_busqueda);
$usuarios_encontrados = $controladorUsuario->listar_usuarios_busqueda($parametro_busqueda);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\resultados_buscador.css">
</head>
<body>

<?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Resultados de la Busqueda</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>

<?php if (mysqli_num_rows($creaturas_usuarios_encontradas) > 0): ?>
    <div class="cont-mini-titular"> 
        <div class="mini-titular">
            <div>Creaturas del Sistema Relacionadas con: <?php echo $parametro_busqueda ?></div>
        </div>
    </div>
    <div class="contenedor-creaturas">
        <?php while ($fila = mysqli_fetch_assoc($creaturas_usuarios_encontradas) ) :
            $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
            $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])
        ?>
        <div class="contenido-creatura" onclick="window.location.href='/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM'">
            <div class="imagen-creatura">
                <img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            </div>
            <div class="nombre-creatura">
                <?= htmlspecialchars($fila['nombre_creatura']) ?>
            </div>
            <div class="tipos">
                <?php if ($fila['id_tipo1'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador'])?>&id_tipo=<?= urlencode($tipo1['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>"
                        <?php if($tipo1['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo1['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo1['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
                <?php if ($fila['id_tipo2'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador'])?>&id_tipo=<?= urlencode($tipo2['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" 
                        <?php if($tipo2['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo2['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo2['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
            </div>
            <div class="rating">
                <?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5 de puntuación
            </div>
            <div class="creador-creatura">
                <?= htmlspecialchars($fila['creador']) ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="contenedor-creaturas x-large">No se encontraron criaturas de usuarios que coincidan con tu busqueda.</div>
<?php endif; ?>

<?php if (mysqli_num_rows($usuarios_encontrados) > 0): ?>
    <div class="cont-mini-titular"> 
        <div class="mini-titular">
            <div>Usuarios Relacionados con: <?php echo $parametro_busqueda ?></div>
        </div>
    </div>
    <div class="contenedor-usuarios">
        <?php while ($fila = mysqli_fetch_assoc($usuarios_encontrados)) : ?>
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
<?php else: ?>
    <div class="contenedor-usuarios x-large">No se encontraron usuarios que coincidan con tu busqueda.</div>
<?php endif; ?>

<?php if (mysqli_num_rows($creaturas_default_encontradas) > 0): ?>
    <div class="cont-mini-titular"> 
        <div class="mini-titular">
            <div>Creaturas del Sistema Relacionadas con: <?php echo $parametro_busqueda ?></div>
        </div>
    </div>
    <div class="contenedor-creaturas">
        <?php while ($fila = mysqli_fetch_assoc($creaturas_default_encontradas) ) :
            $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
            $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])
        ?>
        <div class="contenido-creatura" onclick="window.location.href='/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=SYSTEM'">
            <div class="imagen-creatura">
                <img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            </div>
            <div class="nombre-creatura">
                <?= htmlspecialchars($fila['nombre_creatura']) ?>
            </div>
            <div class="tipos">
                <?php if ($fila['id_tipo1'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador'])?>&id_tipo=<?= urlencode($tipo1['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>"
                        <?php if($tipo1['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo1['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo1['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
                <?php if ($fila['id_tipo2'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador'])?>&id_tipo=<?= urlencode($tipo2['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" 
                        <?php if($tipo2['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo2['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo2['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
            </div>
            <div class="rating">
                <?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5 de puntuación
            </div>
            <div class="creador-creatura">
                <?= htmlspecialchars($fila['creador']) ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="contenedor-creaturas x-large">No se encontraron criaturas default que coincidan con tu busqueda.</div>
<?php endif; ?>

<?php if (isset($creaturas_de_un_tipo) && mysqli_num_rows($creaturas_de_un_tipo) > 0): ?>
    <div>
        <h3>Creaturas del tipo encontradas</h3>
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
                <?php while ($fila = mysqli_fetch_assoc($creaturas_de_un_tipo) ) :

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
<?php endif; ?>

    <?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
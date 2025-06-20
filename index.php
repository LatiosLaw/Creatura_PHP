<?php

require_once("./clases/creatura.php");
require_once("./clases/tipo.php");
require_once("./clases/usuario.php");
$controladorCreatura = new Creatura();
$controladorTipo = new Tipo();
$controladorUsuario = new Usuario();

$lista_creaturas = $controladorCreatura->listar_creaturas_ext(15, "SYSTEM");
$usuarios_aleatorios = $controladorUsuario->listar_usuarios_creadores_aleatorios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creatura</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\inicio.css">
</head>

<body>

    <?php include_once("./piezas_html/cabecera.php"); ?>

    <div class="cont-titular"> 
        <div class="titular">
            <div>Creaturas del Sistema</div>
            <button onclick="location.href='/Creatura_PHP/paginas/todas_las_creaturas.php'">Ver Mas</button>
        </div>
    </div>

    <div class="contenedor-creaturas">
        <?php  while ($fila = mysqli_fetch_assoc($lista_creaturas)) :
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

    <div class="cont-titular"> 
        <div class="titular">
            <div>Algunos Creadores de Creaturas</div>
            <button onclick="location.href='/Creatura_PHP/paginas/todos_los_usuarios.php'">Ver Mas</button>
        </div>
    </div>

    <div class="contenedor-usuarios">
        <?php while ($fila = mysqli_fetch_assoc($usuarios_aleatorios)) : ?>
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
    
    <?php include_once("./piezas_html/pie_pagina.php"); ?>
</body>

</html>
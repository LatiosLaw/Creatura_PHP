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
    <link rel="stylesheet" href="\Creatura_PHP\styles\todas_las_creaturas.css">
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>
<?php include_once("../piezas_html/popup_adaptativo.php"); ?>
<div class="cont-titular"> 
    <div class="titular">
        <div>Todas las Creaturas del Sistema</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>
<div class="contenedor-creaturas">
    <?php while ($fila = mysqli_fetch_assoc($lista_creaturas_default)) :
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
        <div>Algunas Creaturas de Otros Usuarios</div>
    </div>
</div>
<div class="contenedor-creaturas">
    <?php while ($fila = mysqli_fetch_assoc($lista_creaturas_usuarios) ) :
        $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
        $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])
    ?>
    <div class="contenido-creatura" onclick="window.location.href='/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>'">
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
    
    <?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
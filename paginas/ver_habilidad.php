<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['nombre_habilidad']) && isset($_GET['creador']) && isset($_GET['id_habilidad'])) {
    $nombre_habilidad = urldecode($_GET['nombre_habilidad']);
    $creador = urldecode($_GET['creador']);
    $id_habilidad = urldecode($_GET['id_habilidad']);
}

$informacion_habilidad = $controladorCreatura->retornar_habilidad($nombre_habilidad, $creador);
$creaturas_que_aprenden_la_hab = $controladorCreatura->retornar_creaturas_habilidad($id_habilidad);

$info_tipo = $controladorTipo->retornar_tipo($informacion_habilidad['id_tipo_habilidad']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Habilidad - <?php echo $nombre_habilidad ?></title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\ver_habilidad.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>
    <?php include_once("../piezas_html/popup_adaptativo.php"); ?>
<div class="cont-titular"> 
    <div class="titular">
        <div>Información de la Habilidad</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>
<div class="contenido-habilidad">
    <h2>Nombre: <?= htmlspecialchars($informacion_habilidad['nombre_habilidad']) ?></h2>
    <p>Creador: <strong><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($info_tipo['creador'])?>"><?= htmlspecialchars($info_tipo['creador']) ?></a></strong></p>
    <p>Tipo: <strong><a style="color: #<?php echo $info_tipo['color'] ?>;" href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($info_tipo['nombre_tipo']) ?>&creador=<?= urlencode($info_tipo['creador']) ?>&id_tipo=<?= urlencode($info_tipo['id_tipo']) ?>'><?= htmlspecialchars($info_tipo['nombre_tipo']) ?></a></strong></p>
    <p>Categoría: <strong><?= htmlspecialchars($informacion_habilidad['categoria_habilidad']) ?></strong></p>
    <p>Potencia: <strong><?= htmlspecialchars($informacion_habilidad['potencia']) ?></strong></p>
    <p><strong>Descripcion: </strong><?= htmlspecialchars($informacion_habilidad['descripcion']) ?></p>
</div>

<div class="cont-titular"> 
    <div class="titular">
        <div>Creaturas que aprenden <?= htmlspecialchars($informacion_habilidad['nombre_habilidad']) ?></div>
    </div>
</div>
<div class="contenedor-creaturas">
    <?php while ($fila = mysqli_fetch_assoc($creaturas_que_aprenden_la_hab) ) :
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
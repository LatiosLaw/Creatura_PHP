<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['nombre_tipo']) && isset($_GET['creador']) && isset($_GET['id_tipo'])) {
    $id_tipo = urldecode($_GET['id_tipo']);
    $nombre_tipo = urldecode($_GET['nombre_tipo']);
    $creador_cretura = urldecode($_GET['creador']);
}

$informacion_tipo = $controladorTipo->retornar_tipo($id_tipo);
$criaturas_tipo = $controladorTipo->retornar_creaturas_tipo($id_tipo);
$habilidades_tipo = $controladorTipo->retornar_habilidades_tipo($id_tipo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Tipo - <?php echo $nombre_tipo ?></title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\ver_tipo.css">
</head>
<body>
    
<?php include_once("../piezas_html/cabecera.php"); ?>
<?php include_once("../piezas_html/popup_adaptativo.php"); ?>
<div class="cont-titular"> 
    <div class="titular">
        <div>Información del Tipo</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>
<div class="contenido-tipo">
    <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($informacion_tipo['icono']) ?>" alt="Imagen del Tipo" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
    <div class="info-tipo">
        <h2>Tipo <?= htmlspecialchars($informacion_tipo['nombre_tipo']) ?></h2>
        <p>Color: <strong style="color: #<?php echo $informacion_tipo['color']?>;">#<?=htmlspecialchars($informacion_tipo['color']) ?></strong></p>
        <p>Hecho por <strong><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= htmlspecialchars($informacion_tipo['creador'])?>"><?= htmlspecialchars($informacion_tipo['creador']) ?></a></strong></p>
    </div>
</div>

<div class="cont-titular">
    <div class="titular">
        <div>Interacciones defensivas</div>
    </div>
</div>
<div class="defensas">
    <?php
    $efectividades = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($id_tipo, 0);

    // CATEGORIAS - basicamente un array para mostrar cosas después
    $categorias = [
        'Muy débil (x4)' => [],
        'Débil (x2)' => [],
        'Neutro (x1)' => [],
        'Resistente (x0.5)' => [],
        'Muy resistente (x0.25)' => [],
        'Inmune (x0)' => []
    ];

    foreach ($efectividades as $tipo) {
        switch ($tipo['multiplicador']) { //ME ACORDE DE QUE CASE EXISTE YIPPEEEE
            case 0:
                $categorias['Inmune (x0)'][] = $tipo;
                break;
            case 0.25:
                $categorias['Muy resistente (x0.25)'][] = $tipo;
                break;
            case 0.5:
                $categorias['Resistente (x0.5)'][] = $tipo;
                break;
            case 1:
                $categorias['Neutro (x1)'][] = $tipo;
                break;
            case 2:
                $categorias['Débil (x2)'][] = $tipo;
                break;
            case 4:
                $categorias['Muy débil (x4)'][] = $tipo;
                break;
            default:
                $categorias['Neutro (x1)'][] = $tipo;
        }
    }

    // La lista final
    foreach ($categorias as $titulo => $tipos) {
        if (count($tipos) === 0) continue;

        echo "<h3>$titulo</h3>
        <div class='multiplicador'>";

        foreach ($tipos as $tipo) {
            $nombre_tipo = urlencode($tipo['nombre_tipo']);
            $creador = urlencode($tipo['creador']);
            $id_tipo = urlencode($tipo['id_tipo']);
            $color = htmlspecialchars($tipo['color']);
            $icono = htmlspecialchars($tipo['icono']);
            $nombre_mostrar = htmlspecialchars($tipo['nombre_tipo']);
            $multiplicador = htmlspecialchars($tipo['multiplicador']);

            echo "<a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=$nombre_tipo&creador=$creador&id_tipo=$id_tipo' style='background-color: #$color;'>
                <img src='/Creatura_PHP/imagenes/tipos/$icono'> $nombre_mostrar <div>x$multiplicador</div>
            </a>";
        }

        echo "</div>";
    }
    ?>
</div>

<div class="cont-titular">
    <div class="titular">
        <div>Habilidades de tipo <?= htmlspecialchars($informacion_tipo['nombre_tipo']) ?></div>
    </div>
</div>
<div class="habilidades">
    <?php if (count($habilidades_tipo) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Categoría</th>
                    <th>Potencia</th>
                    <th>Descripción</th>
                    <th>Creador</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($habilidades_tipo as $habilidad): ?>
                    <?php $tipo = $controladorTipo->retornar_tipo($habilidad['id_tipo_habilidad']); ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_habilidad.php?nombre_habilidad=<?= urlencode($habilidad['nombre_habilidad'])?>&creador=<?= urlencode($habilidad['creador'])?>&id_habilidad=<?= urlencode($habilidad['id_habilidad'])?>"><div><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></div></a></td>
                        <td style="background-color: #<?= $tipo['color'] ?>;">
                            <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                        </td>
                        <td><?= htmlspecialchars($habilidad['categoria_habilidad']) ?></td>
                        <td><?= $habilidad['potencia'] ?></td>
                        <td><?= htmlspecialchars($habilidad['descripcion']) ?></td>
                        <td><?= htmlspecialchars($habilidad['creador']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No existen habilidades registradas de este tipo.</p>
    <?php endif; ?>
</div>

<?php if (isset($criaturas_tipo) && mysqli_num_rows($criaturas_tipo) > 0): ?>

<div class="cont-titular">
    <div class="titular">
        <div>Creaturas que tienen el tipo <?= htmlspecialchars($informacion_tipo['nombre_tipo']) ?></div>
    </div>
</div>
<div class="contenedor-creaturas">
    <?php while ($fila = mysqli_fetch_assoc($criaturas_tipo) ) :
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
<?php endif; ?>

<?php include_once("../piezas_html/pie_pagina.php"); ?>

</body>
</html>
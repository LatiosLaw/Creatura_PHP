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
</head>
<body>
    
<?php include_once("../piezas_html/cabecera.php"); ?>

<button onclick="history.back();">Volver</button>


<div>
        <h1>Información del Tipo</h1>
        <div style="display: flex; gap: 20px;">
            <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($informacion_tipo['icono']) ?>" alt="Imagen del Tipo" width="200" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            <div>
                <h2><?= htmlspecialchars($informacion_tipo['nombre_tipo']) ?></h2>
                <p style="color: #<?php echo $informacion_tipo['color']?>;"><strong>Color: </strong><?= htmlspecialchars($informacion_tipo['color']) ?></p>
                <p><strong>Creador:</strong> <?= htmlspecialchars($informacion_tipo['creador']) ?></p>
            </div>
        </div>
    </div>

<?php if (isset($criaturas_tipo) && mysqli_num_rows($criaturas_tipo) > 0): ?>
    <div>
        <h3>Creaturas del tipo encontradas</h3>
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo 1</th>
                    <th>Tipo 2</th>
                    <th>Creador</th>
                    <th>Rating</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($criaturas_tipo) ) :

                    $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
                    $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])

                ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><?= htmlspecialchars($fila['nombre_creatura']) ?></a></td>
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
                        <td><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= urlencode($fila['creador'])?>"> <?= htmlspecialchars($fila['creador']) ?></a></td>
                        <td><?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5</td>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div>
        <h2>Habilidades del Tipo</h2>
        <?php if (count($habilidades_tipo) > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
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
                            <td><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></td>
                            <td style="background-color: #<?= $tipo['color'] ?>; color: #fff;">
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

    <div>
        <h2>Interacciones defensivas</h2>

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

            echo "<h3>$titulo</h3><div style='display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1em;'>";

            foreach ($tipos as $tipo) {
                echo "<div style='padding: 8px; background-color: #{$tipo['color']}; border-radius: 5px; color: white; min-width: 100px; text-align: center;'>
                    {$tipo['nombre_tipo']}<br>x{$tipo['multiplicador']}
                </div>";
            }

            echo "</div>";
        }
        ?>
    </div>
    </div>

<?php include_once("../piezas_html/pie_pagina.php"); ?>

</body>
</html>
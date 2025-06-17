<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['creatura']) && isset($_GET['creador'])) {
    $nombre_creatura = urldecode($_GET['creatura']);
    $creador_cretura = urldecode($_GET['creador']);
}

$creatura_elegida = $controladorCreatura->retornar_creatura($nombre_creatura, $creador_cretura);
    if ($creatura_elegida != false) {
        $habilidades = $controladorCreatura->retornar_habilidades($creatura_elegida['id_creatura']);
        $tipo1_elegida = $controladorTipo->retornar_tipo($creatura_elegida['id_tipo1']);
        $tipo2_elegida = $controladorTipo->retornar_tipo($creatura_elegida['id_tipo2']);

        $efectividades = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($tipo1_elegida['id_tipo'], $tipo2_elegida['id_tipo']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Creatura - <?php echo $nombre_creatura ?></title>
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

    <button onclick="history.back();">Volver</button>

    <div>
        <h1>Información de la Creatura</h1>
        <div style="display: flex; gap: 20px;">
            <img src="../imagenes/creaturas/<?= htmlspecialchars($creatura_elegida['imagen']) ?>" alt="Imagen de la creatura" width="200" onerror="this.onerror=null; this.src='../imagenes/sin_imagen.png';">
            <div>
                <h2><?= htmlspecialchars($creatura_elegida['nombre_creatura']) ?></h2>
                <p><strong>Creador:</strong><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= urlencode($creatura_elegida['creador'])?>"> <?= htmlspecialchars($creatura_elegida['creador']) ?></a></p>
                <p><strong>Rating:</strong> <?= htmlspecialchars($creatura_elegida['rating_promedio']) ?>/5</p>
                <p>
                <div style="background-color: #<?= $tipo1_elegida['color']; ?>; color: #fff;"><?= $tipo1_elegida['nombre_tipo']; ?></div>
                <div style="background-color: #<?= $tipo2_elegida['color']; ?>; color: #fff;"><?= $tipo2_elegida['nombre_tipo']; ?></div>
                </p>

                <p><strong>Descripción:</strong> <?= htmlspecialchars($creatura_elegida['descripcion']) ?></p>
                <p><strong>Stats:</strong><br>
                    HP: <?= $creatura_elegida['hp'] ?> |
                    ATK: <?= $creatura_elegida['atk'] ?> |
                    DEF: <?= $creatura_elegida['def'] ?> |
                    SPA: <?= $creatura_elegida['spa'] ?> |
                    SDEF: <?= $creatura_elegida['sdef'] ?> |
                    SPE: <?= $creatura_elegida['spe'] ?>
                </p>
            </div>
        </div>
    </div>

    <div>
        <h2>Habilidades que aprende</h2>
        <?php if (count($habilidades) > 0): ?>
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
                    <?php foreach ($habilidades as $habilidad): ?>
                        <?php $tipo = $controladorTipo->retornar_tipo($habilidad['id_tipo_habilidad']); ?>
                        <tr>
                            <td><a href="/Creatura_PHP/paginas/ver_habilidad.php?nombre_habilidad=<?= urlencode($habilidad['nombre_habilidad'])?>&creador=<?= urlencode($habilidad['creador'])?>&id_habilidad=<?= urlencode($habilidad['id_habilidad'])?>"><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></a></td>
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
            <p>Esta creatura aún no tiene habilidades registradas.</p>
        <?php endif; ?>
    </div>

    <div>
        <h2>Interacciones defensivas</h2>

        <?php
        $efectividades = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($creatura_elegida['id_tipo1'], $creatura_elegida['id_tipo2']);

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
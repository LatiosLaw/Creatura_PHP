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
</head>
<body>
        <?php include_once("../piezas_html/cabecera.php"); ?>
    <button onclick="history.back();">Volver</button>


<div>
        <h1>Información de la Habilidad</h1>
        <div style="display: flex; gap: 20px;">
            <div>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($informacion_habilidad['nombre_habilidad']) ?></p>
                <p><strong>Creador:</strong> <?= htmlspecialchars($informacion_habilidad['creador']) ?></p>
                <p style="color: #<?php echo $info_tipo['color'] ?>;"><strong>Tipo:</strong><?= htmlspecialchars($info_tipo['nombre_tipo']) ?></p>
                <p><strong>Categoria:</strong> <?= htmlspecialchars($informacion_habilidad['categoria_habilidad']) ?></p>
                <p><strong>Potencia:</strong> <?= htmlspecialchars($informacion_habilidad['potencia']) ?></p>
                <p><strong>Descripcion :</strong> <p><?= htmlspecialchars($informacion_habilidad['descripcion']) ?></p></p>
            </div>
        </div>
    </div>

<div>
        <h2>Creaturas que aprenden esta Habilidad</h2>
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
                <?php while ($fila = mysqli_fetch_assoc($creaturas_que_aprenden_la_hab) ) :

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
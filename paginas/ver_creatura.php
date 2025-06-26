<?php
include_once("../piezas_html/cabecera.php");

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

$rating = 0;

if (isset($_SESSION['nickname'])) {
    $nickname_sesion = $_SESSION['nickname'];
    $rating_result = $controladorCreatura->retornar_rating($nickname_sesion, $creatura_elegida['id_creatura']);

    if ($rating_result !== 0 && is_array($rating_result) && isset($rating_result['estrellas'])) {
        $rating = floatval($rating_result['estrellas']); // ej: 3.5
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Creatura - <?php echo $nombre_creatura ?></title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\ver_creatura.css">
</head>
<body>

<div class="cont-titular"> 
    <div class="titular">
        <div>Información de la Creatura</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>
<div class="contenido-creatura">
    <img src="../imagenes/creaturas/<?= htmlspecialchars($creatura_elegida['imagen']) ?>" alt="Imagen de la creatura" onerror="this.onerror=null; this.src='../imagenes/sin_imagen.png';">
    <div class="info-creatura">
        <div class="rycc">
            <div class="creador-creatura">
                <h2><?= htmlspecialchars($creatura_elegida['nombre_creatura']) ?></h2>
                <p>Hecho por <strong><a href="/Creatura_PHP/paginas/ver_usuario.php?usuario=<?= urlencode($creatura_elegida['creador'])?>"> <?= htmlspecialchars($creatura_elegida['creador']) ?></a></strong></p>
            </div>
            <?php include_once("../piezas_html/popup_adaptativo.php"); ?>
            <?php if (isset($_SESSION['nickname'])): ?>
            <div id="rating-container" class="rating"
                data-current="<?= htmlspecialchars($rating) ?>"
                data-creatura-id="<?= $creatura_elegida['id_creatura'] ?>">
                <p>¡Puntua a esta Creatura!</p>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?= $i ?>"></span>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <p>Puntuación de la Creatura: <strong id="promedio-rating"><?= htmlspecialchars($creatura_elegida['rating_promedio']) ?>/5</strong></p>
        <div id="rating-msg"></div>
        <div class="tipos-creatura">
            <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1_elegida['nombre_tipo']) ?>&creador=<?= urlencode($tipo1_elegida['creador']) ?>&id_tipo=<?= urlencode($tipo1_elegida['id_tipo']) ?>' style="background-color: #<?= $tipo1_elegida['color']; ?>;">
                <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1_elegida['icono']; ?>" onerror="this.style.display='none';"><?=$tipo1_elegida['nombre_tipo']; ?>
            </a>
            <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2_elegida['nombre_tipo']) ?>&creador=<?= urlencode($tipo2_elegida['creador']) ?>&id_tipo=<?= urlencode($tipo2_elegida['id_tipo']) ?>' style="background-color: #<?= $tipo2_elegida['color']; ?>;">
            <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2_elegida['icono']; ?>" onerror="this.style.display='none';"><?=$tipo2_elegida['nombre_tipo']; ?>
            </a>
        </div>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($creatura_elegida['descripcion']) ?></p>

        <div class="stats">
            <p>Estadisticas: </p>
            <strong>HP </strong>
            <div class="barra" data-value="<?= $creatura_elegida['hp'] ?>" data-max-value="255" data-type="HP">
                <div class="barra-inner"><div><?= $creatura_elegida['hp'] ?></div></div>
            </div>

            <strong>ATK </strong>
            <div class="barra" data-value="<?= $creatura_elegida['atk'] ?>" data-max-value="255" data-type="ATK">
                <div class="barra-inner"><div><?= $creatura_elegida['atk'] ?></div></div>
            </div>

            <strong>DEF </strong>
            <div class="barra" data-value="<?= $creatura_elegida['def'] ?>" data-max-value="255" data-type="DEF">
                <div class="barra-inner"><div><?= $creatura_elegida['def'] ?></div></div>
            </div>

            <strong>SPA </strong>
            <div class="barra" data-value="<?= $creatura_elegida['spa'] ?>" data-max-value="255" data-type="SPA">
                <div class="barra-inner"><div><?= $creatura_elegida['spa'] ?></div></div>
            </div>

            <strong>SDEF </strong>
            <div class="barra" data-value="<?= $creatura_elegida['sdef'] ?>" data-max-value="255" data-type="SDEF">
                <div class="barra-inner"><div><?= $creatura_elegida['sdef'] ?></div></div>
            </div>

            <strong>SPE </strong>
            <div class="barra" data-value="<?= $creatura_elegida['spe'] ?>" data-max-value="255" data-type="SPE">
                <div class="barra-inner"><div><?= $creatura_elegida['spe'] ?></div></div>
            </div>
        </div>
    </div>
</div>

<div class="cont-titular"> 
    <div class="titular">
        <div>Interacciones defensivas</div>
    </div>
</div>
<div class="defensas">
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
        <div>Habilidades que puede aprender</div>
    </div>
</div>
<div class="habilidades">
    <?php if (count($habilidades) > 0): ?>
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
                <?php foreach ($habilidades as $habilidad): ?>
                    <?php $tipo = $controladorTipo->retornar_tipo($habilidad['id_tipo_habilidad']); ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_habilidad.php?nombre_habilidad=<?= urlencode($habilidad['nombre_habilidad'])?>&creador=<?= urlencode($habilidad['creador'])?>&id_habilidad=<?= urlencode($habilidad['id_habilidad'])?>"><div><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></div></a></td>
                        <td style="background-color: #<?= $tipo['color'] ?>;">
                            <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo['nombre_tipo']) ?>&creador=<?= urlencode($tipo['creador']) ?>&id_tipo=<?= urlencode($tipo['id_tipo']) ?>'>
                            <div><?= htmlspecialchars($tipo['nombre_tipo']) ?></div>
                        </a></td>
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

    <?php include_once("../piezas_html/pie_pagina.php"); ?>

<script>
    
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("rating-container");
    if (!container) return;

    let currentRating = parseFloat(container.dataset.current) || 0;
    const stars = container.querySelectorAll(".star");
    const id_creatura = container.dataset.creaturaId;

    function actualizarVisual(rating) {
        stars.forEach((star, index) => {
            const starValue = index + 1;
            if (rating >= starValue) {
                // estrella llena
                star.textContent = '★';
                star.style.color = 'gold';
                star.style.clipPath = 'none';
            } else if (rating >= starValue - 0.5) {
                // media estrella
                star.textContent = '★';
                star.style.color = 'gold';
                star.style.position = 'relative';
                star.style.clipPath = 'inset(0 50% 0 0)'; // mostrar solo mitad izquierda
            } else {
                // estrella vacía
                star.textContent = '☆';
                star.style.color = 'gray';
                star.style.clipPath = 'none';
            }
        });
    }

    actualizarVisual(currentRating);

    stars.forEach(star => {
        star.addEventListener("click", function (e) {
            const starValue = parseInt(this.dataset.value);
            const rect = this.getBoundingClientRect();
            const clickX = e.clientX - rect.left;

            let nuevoValor;
            if (clickX < rect.width / 2) {
                // Click en mitad izquierda = media estrella
                nuevoValor = starValue - 0.5;
            } else {
                // Click en mitad derecha = estrella completa
                nuevoValor = starValue;
            }

            fetch("/Creatura_PHP/procesamiento/dinamico/guardar_rating.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id_creatura=${id_creatura}&puntaje=${nuevoValor}`
            })
            .then(response => response.json())
.then(data => {
    if (data.success) {
        currentRating = nuevoValor;
        actualizarVisual(currentRating);
        document.getElementById("rating-msg").textContent = "¡Tu puntuación se ha guardado!";
        
        const ratingMsg = document.getElementById("rating-msg");
        ratingMsg.style.display = 'block';

        const promedioElem = document.getElementById("promedio-rating");
        if (promedioElem && data.nuevo_promedio !== undefined) {
            promedioElem.textContent = data.nuevo_promedio + "/5";
        }
    } else {
        const ratingMsg = document.getElementById("rating-msg");
        ratingMsg.textContent = "Error: " + (data.error || "desconocido");

        ratingMsg.style.display = 'block';
    }
})
            .catch(err => {
                console.error("Error al guardar el rating", err);
            });
        });
    });
});

    function getColor(valor) {
    let r, g, b;

    if (valor <= 50) {
        const factor = valor / 50;
        r = 255;
        g = Math.round(165 * factor);
        b = 0;
    } else if (valor <= 80) {
        const factor = (valor - 40) / 40;
        r = 255;
        g = Math.round(175 + (90 * factor));
        b = 0;
    } else if (valor <= 110) {
        const factor = (valor - 80) / 30;
        r = Math.round(255 * (1 - factor));
        g = 255;
        b = 0;
    } else {
        const factor = (valor - 110) / 145;
        r = Math.round(0 + (100 * factor));
        g = Math.round(255 - (35 * factor));
        b = Math.round(0 + (255 * factor));
    }

    return `rgb(${r}, ${g}, ${b})`;
}

    window.onload = function () {
        const barras = document.querySelectorAll('.barra');

        barras.forEach(function (barra) {
            const value = parseInt(barra.getAttribute('data-value'));
            const maxValue = parseInt(barra.getAttribute('data-max-value'));

            const porcentaje = (value / maxValue) * 100;

            const barraInner = barra.querySelector('.barra-inner');
            barraInner.style.width = porcentaje + '%';
            barraInner.style.backgroundColor = getColor(value);
        });
    };
</script>

</body>
</html>
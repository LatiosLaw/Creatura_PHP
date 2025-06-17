<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['nombre_habilidad']) && isset($_GET['creador'])) {
    $nombre_habilidad = urldecode($_GET['nombre_habilidad']);
    $creador_cretura = urldecode($_GET['creador']);
}

$informacion_habilidad = $controladorCreatura->retornar_habilidad($nombre_habilidad, $creador_cretura);

$lista_tipos = $controladorTipo->listar_tipos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habilidad - <?php echo $nombre_habilidad ?></title>
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>
    <button onclick="history.back();">Volver</button>


<div>
            <form action="../procesamiento/manejar_modificacionHabilidad.php?id_habilidad=<?php echo $informacion_habilidad['id_habilidad']?>&creador=<?php echo $informacion_habilidad['creador']?>" method="POST">
                Nombre <input name="nombre" type="text" value="<?php echo $informacion_habilidad['nombre_habilidad'] ?>"><br>
                TIPO<select name="tipo" id="tipo">
    <option value="">Selecciona un tipo</option>
    <?php foreach ($lista_tipos as $tipo): ?>
        <option value="<?= $tipo['id_tipo'] ?>" 
            <?= $informacion_habilidad['id_tipo_habilidad'] == $tipo['id_tipo'] ? 'selected' : '' ?>
            style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
            <?= htmlspecialchars($tipo['nombre_tipo']) ?>
        </option>
    <?php endforeach; ?>
</select>
<br>
                Categoria del ataque<select name="categoria" id="categoria">
    <option value="">Selecciona una categoría</option>
    <option value="FISICO" <?= $informacion_habilidad['categoria_habilidad'] == 'FISICO' ? 'selected' : '' ?>>FISICO</option>
    <option value="ESPECIAL" <?= $informacion_habilidad['categoria_habilidad'] == 'ESPECIAL' ? 'selected' : '' ?>>ESPECIAL</option>
    <option value="ESTADO" <?= $informacion_habilidad['categoria_habilidad'] == 'ESTADO' ? 'selected' : '' ?>>ESTADO</option>
</select>
<br>

                Potencia<input name="potencia" type="number" placeholder="70" value="<?php echo $informacion_habilidad['potencia'] ?>"><br>

                Descripcion <input name="descripcion" type="text" value="<?php echo $informacion_habilidad['descripcion'] ?>"><br>
                <input type="submit">
            </form>
        </div>

    <?php include_once("../piezas_html/pie_pagina.php"); ?>

    <script>
        document.getElementById('categoria').addEventListener('change', function() {
            const potenciaInput = document.querySelector('input[name="potencia"]');

            if (this.value === 'ESTADO') {
                potenciaInput.value = 0;
                potenciaInput.readOnly = true;
            } else {
                potenciaInput.readOnly = false;
            }
        });
    </script>
</body>
</html>
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
    <link rel="stylesheet" href="\Creatura_PHP\styles\editar_habilidad.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Habilidad</div>
        <button onclick="history.back();">Cancelar</button>
    </div>
</div>
<form action="../procesamiento/manejar_modificacionHabilidad.php?id_habilidad=<?php echo $informacion_habilidad['id_habilidad']?>&creador=<?php echo $informacion_habilidad['creador']?>" method="POST">
    <div class="guardar">
        <button type="submit">Guardar Cambios</button>
    </div>
    <div class="contenido-habilidad">
        <div class="info-habilidad">
            <p>Nombre</p>
            <input name="nombre" type="text" value="<?php echo $informacion_habilidad['nombre_habilidad'] ?>" required>
            <p>Descripción</p>
            <input name="descripcion" type="text" value="<?php echo $informacion_habilidad['descripcion'] ?>">
        </div>
        <div class="tcp">
            <div class="tipo-categoria">
                <div>
                    <p>Tipo</p>
                    <select name="tipo" id="tipo" required>
                        <option value="">Selecciona un tipo</option>
                        <?php foreach ($lista_tipos as $tipo): ?>
                            <option value="<?= $tipo['id_tipo'] ?>" <?= $informacion_habilidad['id_tipo_habilidad'] == $tipo['id_tipo'] ? 'selected' : '' ?> style="background-color: #<?= htmlspecialchars($tipo['color']) ?>;">
                                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <p>Categoría del ataque</p>
                    <select name="categoria" id="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="FISICO" <?= $informacion_habilidad['categoria_habilidad'] == 'FISICO' ? 'selected' : '' ?>>FISICO</option>
                        <option value="ESPECIAL" <?= $informacion_habilidad['categoria_habilidad'] == 'ESPECIAL' ? 'selected' : '' ?>>ESPECIAL</option>
                        <option value="ESTADO" <?= $informacion_habilidad['categoria_habilidad'] == 'ESTADO' ? 'selected' : '' ?>>ESTADO</option>
                    </select>
                </div>
            </div>
            <div class="potencia">
                <div>
                    <p>Potencia</p>
                    <input name="potencia" type="number" value="<?php echo $informacion_habilidad['potencia'] ?>" required>
                </div>
            </div>
        </div>
    </div>
</form>
        

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
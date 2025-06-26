<?php

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$lista_tipos = $controladorTipo->listar_tipos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tipo</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\alta_habilidad.css">
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Habilidad</div>
        <button onclick="history.back();">Cancelar</button>
    </div>
</div>
<form action="/Creatura_PHP/procesamiento/manejar_altaHabilidad.php" method="POST">
    <div class="guardar">
        <button type="submit">Confirmar Creación</button>
    </div>
    <div class="contenido-habilidad">
        <div class="info-habilidad">
            <p>Nombre</p>
            <input name="nombre" type="text" required>
            <p>Descripción</p>
            <input name="descripcion" type="text">
        </div>
        <div class="tcp">
            <div class="tipo-categoria">
                <div>
                    <p>Tipo</p>
                    <select name="tipo" id="tipo" required>
                        <option value="">Selecciona un tipo</option>
                        <?php foreach ($lista_tipos as $tipo): ?>
                            <option value="<?= $tipo['id_tipo'] ?>" style="background-color: #<?= htmlspecialchars($tipo['color']) ?>;">
                                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <p>Categoría del ataque</p>
                    <select name="categoria" id="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="FISICO">FISICO</option>
                        <option value="ESPECIAL">ESPECIAL</option>
                        <option value="ESTADO">ESTADO</option>
                    </select>
                </div>
            </div>
            <div class="potencia">
                <div>
                    <p>Potencia</p>
                    <input name="potencia" type="number" required>
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
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
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

<button onclick="history.back();">Volver</button>

 <div>
            <form action="/Creatura_PHP/procesamiento/manejar_altaHabilidad.php" method="POST">
                Nombre <input name="nombre" type="text"><br>
                TIPO<select name="tipo" id="tipo">
                    <option value="">Selecciona un tipo</option>
                    <?php foreach ($lista_tipos as $tipo): ?>
                        <option value="<?= $tipo['id_tipo'] ?>" style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                            <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
                Categoria del ataque<select name="categoria" id="categoria">
                    <option value="">Selecciona una categoría</option>
                    <option value="FISICO">FISICO</option>
                    <option value="ESPECIAL">ESPECIAL</option>
                    <option value="ESTADO">ESTADO</option>
                </select><br>

                Potencia<input name="potencia" type="number" placeholder="70"><br>

                Descripcion <input name="descripcion" type="text"><br>
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
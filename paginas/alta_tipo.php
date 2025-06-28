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
    <link rel="stylesheet" href="\Creatura_PHP\styles\alta_tipo.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>

    <?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Tipo</div>
        <button onclick="history.back();">Cancelar</button>
    </div>
</div>
<form action="../procesamiento/manejar_altaTipo.php" method="POST" enctype="multipart/form-data">
    <div class="guardar">
        <button type="submit">Confirmar Creación</button>
    </div>
    <div class="contenido-tipo">
        <div class="imagen">
            <p>Icono del Tipo</p>
            <input name="icono" type="file" accept="image/png, image/jpeg" id="imageInput">
            <img id="typeImage" src="/Creatura_PHP/imagenes/sin_imagen.png">
            <p class="msg">Con el fin de evitar que el icono se vea pequeño, intente que su imagen cubra el mayor espacio posible</p>
        </div>
        <div class="info-tipo">
            <div class="info">
                <p>Nombre</p>
                <input name="nombre" type="text" required>
            </div>
            <div class="color">
                <div>
                    <p>Color</p>
                    <input name="color" type="color" value="#FFFFFF">
                </div>
            </div>
        </div>
    </div>
    <div class="defensas">
        <div class="cont-mini-titular first-mini-t"> 
            <div class="mini-titular">
                <div>Interaccion consigo mismo (Opcional)</div>
                <select id="self-int" name="self-int">
                    <option value="1">Selecciona una interacción</option>
                    <option value="1">Neutro a si mismo</option>
                    <option value="2">Debil a si mismo</option>
                    <option value="0.5">Resistente a si mismo</option>
                    <option value="0">Inmune a si mismo</option>
                </select>
            </div>
        </div>
        <div class="cont-mini-titular"> 
            <div class="mini-titular">
                <div>Debilidades (Opcional)</div>
                <select id="select-debilidad"></select>
            </div>
        </div>
        <div class="multiplicador" id="tabla-debilidad"></div>

        <div class="cont-mini-titular"> 
            <div class="mini-titular">
                <div>Resistencias (Opcional)</div>
                <select id="select-resistencia"></select>
            </div>
        </div>
        <div class="multiplicador" id="tabla-resistencia"></div>

        <div class="cont-mini-titular"> 
            <div class="mini-titular">
                <div>Inmunidades (Opcional)</div>
                <select id="select-inmunidad"></select>
            </div>
        </div>
        <div class="multiplicador" id="tabla-inmunidad"></div>
    </div>
</form>

<?php include_once("../piezas_html/pie_pagina.php"); ?>

<script>
        const listaTipos = <?= json_encode($lista_tipos) ?>;
        let tiposDisponibles = [...listaTipos];
        let tiposSeleccionados = {
            debilidad: [],
            resistencia: [],
            inmunidad: []
        };

        function actualizarSelects() {
            ['debilidad', 'resistencia', 'inmunidad'].forEach(categoria => {
                const select = document.getElementById(`select-${categoria}`);
                select.innerHTML = '<option value="">Selecciona un tipo</option>';
                tiposDisponibles.forEach(tipo => {
                    const option = document.createElement('option');
                    option.value = tipo.id_tipo;
                    option.textContent = tipo.nombre_tipo;
                    option.style.backgroundColor = `#${tipo.color}`;
                    select.appendChild(option);
                });
            });
        }

        function agregarTipo(categoria, id_tipo) {
            const tipo = tiposDisponibles.find(t => t.id_tipo == id_tipo);
            if (!tipo) return;

            tiposSeleccionados[categoria].push(tipo);
            tiposDisponibles = tiposDisponibles.filter(t => t.id_tipo != id_tipo);
            actualizarSelects();
            renderizarTabla(categoria);
        }

        function eliminarTipo(categoria, id_tipo) {
            const tipo = tiposSeleccionados[categoria].find(t => t.id_tipo == id_tipo);
            if (!tipo) return;

            tiposSeleccionados[categoria] = tiposSeleccionados[categoria].filter(t => t.id_tipo != id_tipo);
            tiposDisponibles.push(tipo);
            actualizarSelects();
            renderizarTabla(categoria);
        }

        function renderizarTabla(categoria) {
            const tabla = document.getElementById(`tabla-${categoria}`);
            tabla.innerHTML = '';
            tiposSeleccionados[categoria].forEach(tipo => {
                const fila = document.createElement('div');
                fila.classList.add('tipo');
                fila.style.backgroundColor = `#${tipo.color}`;
                fila.innerHTML = `
                    <img src="../imagenes/tipos/${tipo.icono}" alt="icono" width="24" height="24" onerror="this.onerror=null; this.src='../imagenes/sin_imagen.png';">
                    ${tipo.nombre_tipo}
                    <button type="button" onclick="eliminarTipo('${categoria}', ${tipo.id_tipo})">&times;</button>
                    <input type="hidden" name="${categoria}[]" value="${tipo.id_tipo}">
                `;
                tabla.appendChild(fila);
            });
        }

        // Eventos para selects
        document.getElementById('select-debilidad').addEventListener('change', function() {
            if (this.value) agregarTipo('debilidad', this.value);
            this.value = '';
        });
        document.getElementById('select-resistencia').addEventListener('change', function() {
            if (this.value) agregarTipo('resistencia', this.value);
            this.value = '';
        });
        document.getElementById('select-inmunidad').addEventListener('change', function() {
            if (this.value) agregarTipo('inmunidad', this.value);
            this.value = '';
        });

        actualizarSelects();

        document.getElementById('imageInput').addEventListener('change', function(event) {
                    const file = event.target.files[0];

                    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            document.getElementById('typeImage').src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                    }
                });
    </script>

</body>
</html>
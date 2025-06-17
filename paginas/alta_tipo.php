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

<button onclick="window.location.href = document.referrer || '/Creatura_PHP/index.php';">Volver</button>
    
<div>
            <form action="../procesamiento/manejar_altaTipo.php" method="POST" enctype="multipart/form-data">
                Nombre <input name="nombre" type="text" required><br>
                Color <input name="color" type="color"><br>
                Icono del Tipo <input name="icono" type="file" accept="image/png, image/jpeg"><br>
                <div>
                    <label>Debilidades</label>
                    <select id="select-debilidad"></select>
                    <table id="tabla-debilidad"></table>
                </div>

                <div>
                    <label>Resistencias</label>
                    <select id="select-resistencia"></select>
                    <table id="tabla-resistencia"></table>
                </div>

                <div>
                    <label>Inmunidades</label>
                    <select id="select-inmunidad"></select>
                    <table id="tabla-inmunidad"></table>
                </div>

                <div>
                    <label>Interaccion consigo mismo</label>
                    <select id="self-int" name="self-int">
                        <option value="1">-</option>
                        <option value="2">Debil a si mismo</option>
                        <option value="0.5">Resistente a si mismo</option>
                        <option value="0">Inmune a si mismo</option>
                    </select>
                </div>

                <input type="submit">
            </form>
        </div>

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
                    option.style.color = `#${tipo.color}`;
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
                const fila = document.createElement('tr');
                fila.innerHTML = `
            <td>
                <img src="../imagenes/tipos/${tipo.icono}" alt="icono" width="24" height="24"
                     onerror="this.onerror=null; this.src='../imagenes/sin_imagen.png';">
            </td>
            <td style="color: #${tipo.color}">${tipo.nombre_tipo}</td>
            <td>
                <button type="button" onclick="eliminarTipo('${categoria}', ${tipo.id_tipo})">X</button>
                <input type="hidden" name="${categoria}[]" value="${tipo.id_tipo}">
            </td>
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
    </script>

</body>
</html>
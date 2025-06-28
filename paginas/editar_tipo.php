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

$interacciones = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($id_tipo, 0);

$lista_tipos = $controladorTipo->listar_tipos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo - <?php echo $nombre_tipo ?></title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\editar_tipo.css">
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
<form action="/Creatura_PHP/procesamiento/manejar_modificacionTipo.php?id_tipo=<?php echo $id_tipo ?>" method="POST" enctype="multipart/form-data">
    <input name="nombre_original" type="text" value="<?php echo $informacion_tipo['nombre_tipo']?>" hidden>
    <div class="guardar">
        <button type="submit">Guardar Cambios</button>
    </div>
    <div class="contenido-tipo">
        <div class="imagen">
            <p>Nuevo Icono del Tipo (Opcional)</p><input name="icono" type="file" accept="image/png, image/jpeg" id="imageInput">
            <img id="typeImage" src="/Creatura_PHP/imagenes/tipos/<?php echo $informacion_tipo['icono']?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            <p class="msg">Con el fin de evitar que el icono se vea pequeño, intente que su imagen cubra el mayor espacio posible</p>
        </div>
        <div class="info-tipo">
            <div class="info">
                <p>Nombre</p>
                <input name="nombre" type="text" value="<?php echo $informacion_tipo['nombre_tipo']?>" required>
            </div>
            <div class="color">
                <div>
                    <p>Color</p>
                    <input name="color" type="color" value="#<?php echo $informacion_tipo['color']?>">
                </div>
            </div>
        </div>
    </div>
    <div class="defensas">   
        <div class="cont-mini-titular first-mini-t"> 
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
    const interacciones = <?= json_encode($interacciones) ?>;

    let tiposDisponibles = [...listaTipos];
    let tiposSeleccionados = {
        debilidad: [],
        resistencia: [],
        inmunidad: []
    };

    interacciones.forEach(interaccion => {
    const tipo = listaTipos.find(t => t.id_tipo == interaccion.id_tipo);
    if (!tipo) return;

    if (interaccion.multiplicador > 1) {
        tiposSeleccionados.debilidad.push(tipo);
        tiposDisponibles = tiposDisponibles.filter(t => t.id_tipo != tipo.id_tipo);
    } else if (interaccion.multiplicador === 0) {
        tiposSeleccionados.inmunidad.push(tipo);
        tiposDisponibles = tiposDisponibles.filter(t => t.id_tipo != tipo.id_tipo);
    } else if (interaccion.multiplicador < 1) {
        tiposSeleccionados.resistencia.push(tipo);
        tiposDisponibles = tiposDisponibles.filter(t => t.id_tipo != tipo.id_tipo);
    }
    // Si multiplicador === 1 => no hacemos nada
});

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

    document.getElementById('select-debilidad').addEventListener('change', function () {
        if (this.value) agregarTipo('debilidad', this.value);
        this.value = '';
    });
    document.getElementById('select-resistencia').addEventListener('change', function () {
        if (this.value) agregarTipo('resistencia', this.value);
        this.value = '';
    });
    document.getElementById('select-inmunidad').addEventListener('change', function () {
        if (this.value) agregarTipo('inmunidad', this.value);
        this.value = '';
    });

    actualizarSelects();
    ['debilidad', 'resistencia', 'inmunidad'].forEach(renderizarTabla);

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
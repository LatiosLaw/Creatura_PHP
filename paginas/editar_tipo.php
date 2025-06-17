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
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>
    <button onclick="history.back();">Volver</button>


    <div>
            <form action="/Creatura_PHP/procesamiento/manejar_modificacionTipo.php?id_tipo=<?php echo $id_tipo ?>" method="POST" enctype="multipart/form-data">
                Nombre <input name="nombre" type="text" value="<?php echo $informacion_tipo['nombre_tipo']?>"><br>
                Color <input name="color" type="color" value="#<?php echo $informacion_tipo['color']?>"><br>
                Icono del Tipo <img src="/Creatura_PHP/imagenes/tipos/<?php echo $informacion_tipo['icono']?>" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"><br>
                Nuevo Icono del Tipo (Opcional) <input name="icono" type="file" accept="image/png, image/jpeg"><br>
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

                <input type="submit">
            </form>
        </div>

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
</script>

</body>
</html>
<?php

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['nombre_creatura']) && isset($_GET['creador'])) {
    $nombre_creatura = urldecode($_GET['nombre_creatura']);
    $creador_cretura = urldecode($_GET['creador']);
    $id_creatura = urldecode($_GET['id_creatura']);
}

$informacion_creatura = $controladorCreatura->retornar_creatura($nombre_creatura, $creador_cretura);
$movimientos_creatura = $controladorCreatura->retornar_habilidades($id_creatura);

$lista_tipos = $controladorTipo->listar_tipos();
$lista_tipos_habilidad = $controladorTipo->listar_tipos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Creatura - <?php echo $nombre_creatura ?></title>
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>
    <button onclick="history.back();">Volver</button>

<div>
            <form id="formAltaCreatura" action="/Creatura_PHP/procesamiento/manejar_modificacionCreatura.php?id_creatura=<?php echo $informacion_creatura['id_creatura']?>&creador=<?php echo $informacion_creatura['creador']?>&nombre_creatura=<?php echo $informacion_creatura['nombre_creatura']?>" method="POST" enctype="multipart/form-data">
                Nombre <input name="nombre" type="text" value="<?= htmlspecialchars($informacion_creatura['nombre_creatura']) ?>" required><br>
                TIPO 1
                <select name="tipo1" id="tipo1" onchange="reconstruirSelects('tipo1')" required>
            <?php foreach ($lista_tipos as $tipo): ?>
                <option value="<?= $tipo['id_tipo'] ?>" <?= $tipo['id_tipo'] == $informacion_creatura['id_tipo1'] ? 'selected' : '' ?> style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                    <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>


                TIPO 2
               <select name="tipo2" id="tipo2" onchange="reconstruirSelects('tipo2')">
            <?php foreach ($lista_tipos as $tipo): ?>
                <option value="<?= $tipo['id_tipo'] ?>" <?= $tipo['id_tipo'] == $informacion_creatura['id_tipo2'] ? 'selected' : '' ?> style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                    <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        Imagen <img src="/Creatura_PHP/imagenes/creaturas/<?php echo $informacion_creatura['imagen']; ?>" width="100" height="100"><br>

                Imagen Nueva (Opcional) <input name="imagen" type="file" accept="image/png, image/jpeg"><br>

                HP
<input name="hp" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['hp'] ?>" oninput="sincronizarValor(this, 'hp_val')">
<input id="hp_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['hp'] ?>" oninput="sincronizarSlider(this, 'hp')"><br>

ATK
<input name="atk" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['atk'] ?>" oninput="sincronizarValor(this, 'atk_val')">
<input id="atk_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['atk'] ?>" oninput="sincronizarSlider(this, 'atk')"><br>

DEF
<input name="def" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['def'] ?>" oninput="sincronizarValor(this, 'def_val')">
<input id="def_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['def'] ?>" oninput="sincronizarSlider(this, 'def')"><br>

SPA
<input name="spa" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['spa'] ?>" oninput="sincronizarValor(this, 'spa_val')">
<input id="spa_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['spa'] ?>" oninput="sincronizarSlider(this, 'spa')"><br>

SPDEF
<input name="spdef" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['sdef'] ?>" oninput="sincronizarValor(this, 'spdef_val')">
<input id="spdef_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['sdef'] ?>" oninput="sincronizarSlider(this, 'spdef')"><br>

SPE
<input name="spe" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['spe'] ?>" oninput="sincronizarValor(this, 'spe_val')">
<input id="spe_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['spe'] ?>" oninput="sincronizarSlider(this, 'spe')"><br>

                Descripcion <input name="descripcion" type="text" value="<?= htmlspecialchars($informacion_creatura['descripcion']) ?>"><br>

                <?php
                $lista_tipos_habilidad = $controladorTipo->listar_tipos();
                ?>

Visibilidad 
                <select id="publico" name="publico" required>
    <option value="">-- Selecciona Visiblidad --</option>
    <option value="1" <?= ($informacion_creatura['publico'] == 1) ? 'selected' : '' ?>>Pública</option>
    <option value="0" <?= ($informacion_creatura['publico'] == 0) ? 'selected' : '' ?>>Privada</option>
</select><br>


                <h4>Habilidades</h4>
                Disponibles : <br>
                <label for="filtroTipoHabilidad">Filtrar por tipo:</label>
                <select id="filtroTipoHabilidad" onchange="retornarHabilidades(this.value)">
                    <option value="">-- Selecciona un tipo --</option>
                    <?php foreach ($lista_tipos_habilidad as $tipo): ?>
                        <option value="<?= $tipo['id_tipo'] ?>" style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                            <?= htmlspecialchars($tipo['nombre_tipo']) ?></option>
                    <?php endforeach; ?>
                </select><br>

                <table id="tablaHabilidades" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Potencia</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                Seleccionadas : <br>
                <table id="tablaSeleccionadas" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Potencia</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <input type="hidden" name="habilidades_json" id="habilidades_json">

                <input type="submit">
            </form>
        </div>

        <script>
            
        const tipos = <?= json_encode($lista_tipos) ?>;

        function sincronizarValor(slider, inputId) {
    document.getElementById(inputId).value = slider.value;
}

// Actualiza el slider cuando se cambia manualmente el número
function sincronizarSlider(input, sliderName) {
    const slider = document.querySelector(`input[name='${sliderName}']`);
    let valor = parseInt(input.value);

    if (isNaN(valor)) valor = 1;
    if (valor < 1) valor = 1;
    if (valor > 255) valor = 255;

    input.value = valor;
    slider.value = valor;
}

        function obtenerColorTipo(id_tipo) {
            const tipo = tipos.find(t => t.id_tipo == id_tipo);
            return tipo ? `#${tipo.color}` : '#000000'; // negro si no se encuentra
        }

    const habilidadesIniciales = <?= json_encode($movimientos_creatura) ?>;

// Cargamos directamente las habilidades preseleccionadas al array de control
const habilidadesSeleccionadas = habilidadesIniciales.map(hab => ({
    id: hab.id_habilidad,
    nombre: hab.nombre_habilidad,
    descripcion: hab.descripcion,
    categoria: hab.categoria_habilidad,
    potencia: hab.potencia,
    color: obtenerColorTipo(hab.id_tipo_habilidad)
}));

document.addEventListener("DOMContentLoaded", () => {
    reconstruirAmbosSelects();
    actualizarTablaSeleccionadas(); // Pintamos la tabla con las habilidades ya existentes

    document.getElementById("tipo1").addEventListener("change", reconstruirAmbosSelects);
    document.getElementById("tipo2").addEventListener("change", reconstruirAmbosSelects);
});


        function retornarHabilidades(id_tipo) {
    if (!id_tipo) return;

    fetch(`../procesamiento/dinamico/obtener_habilidades_tipo.php?id_tipo=${id_tipo}`)
        .then(res => res.json())
        .then(habilidades => {
            const tbody = document.querySelector("#tablaHabilidades tbody");
            tbody.innerHTML = "";

            habilidades.forEach(hab => {
                const color = obtenerColorTipo(hab.id_tipo_habilidad);
                const tr = document.createElement("tr");

                // Creamos celdas
                const tdId = document.createElement("td");
                tdId.textContent = hab.id_habilidad;

                const tdNombre = document.createElement("td");
                tdNombre.textContent = hab.nombre_habilidad;
                tdNombre.style.color = color;

                const tdDescripcion = document.createElement("td");
                tdDescripcion.textContent = hab.descripcion;

                const tdCategoria = document.createElement("td");
                tdCategoria.textContent = hab.categoria_habilidad;

                const tdPotencia = document.createElement("td");
                tdPotencia.textContent = hab.potencia;

                const tdAccion = document.createElement("td");
                const boton = document.createElement("button");
                boton.type = "button";
                boton.textContent = "Agregar";
                boton.onclick = () => {
                    agregarHabilidad(
                        hab.id_habilidad,
                        hab.nombre_habilidad,
                        hab.descripcion,
                        hab.categoria_habilidad,
                        hab.potencia,
                        color
                    );
                };
                tdAccion.appendChild(boton);

                // Agregamos todo al <tr>
                tr.appendChild(tdId);
                tr.appendChild(tdNombre);
                tr.appendChild(tdDescripcion);
                tr.appendChild(tdCategoria);
                tr.appendChild(tdPotencia);
                tr.appendChild(tdAccion);

                // Finalmente, agregamos el <tr> a la tabla
                tbody.appendChild(tr);
            });
        })
        .catch(err => console.error("Error al cargar habilidades:", err));
}


        function agregarHabilidad(id, nombre, descripcion, categoria, potencia, color) {
            if (habilidadesSeleccionadas.find(h => h.id === id)) {
                alert("Ya seleccionaste esta habilidad.");
                return;
            }

            habilidadesSeleccionadas.push({
                id,
                nombre,
                descripcion,
                categoria,
                potencia,
                color
            });
            actualizarTablaSeleccionadas();
        }

        function eliminarHabilidad(id) {
            const index = habilidadesSeleccionadas.findIndex(h => h.id === id);
            if (index !== -1) {
                habilidadesSeleccionadas.splice(index, 1);
                actualizarTablaSeleccionadas();
            }
        }

        function actualizarTablaSeleccionadas() {
            const tbody = document.querySelector("#tablaSeleccionadas tbody");
            tbody.innerHTML = "";

            habilidadesSeleccionadas.forEach(hab => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
            <td>${hab.id}</td>
                <td style="color: ${hab.color};">${hab.nombre}</td>
            <td>${hab.descripcion}</td>
            <td>${hab.categoria}</td>
            <td>${hab.potencia}</td>
            <td><button type="button" onclick="eliminarHabilidad(${hab.id})">Quitar</button></td>
        `;
                tbody.appendChild(tr);
            });

            document.getElementById("habilidades_json").value = JSON.stringify(habilidadesSeleccionadas);
        }

        // Reconstruye completamente un select, excluyendo un valor si se indica
        function poblarSelect(select, excluir) {
            const valorActual = select.value;
            select.innerHTML = '<option value="">-</option>';
            tipos.forEach(tipo => {
                if (tipo.id_tipo != excluir) {
                    const option = document.createElement("option");
                    option.value = tipo.id_tipo;
                    option.textContent = tipo.nombre_tipo;
                    option.style.color = `#${tipo.color}`;
                    select.appendChild(option);
                }
            });
            // Restaurar el valor si sigue siendo válido
            if (valorActual && valorActual !== excluir) {
                select.value = valorActual;
            }
        }

        function reconstruirAmbosSelects() {
            const tipo1 = document.getElementById("tipo1").value;
            const tipo2 = document.getElementById("tipo2").value;

            poblarSelect(document.getElementById("tipo1"), tipo2);
            poblarSelect(document.getElementById("tipo2"), tipo1);
        }

        document.addEventListener("DOMContentLoaded", () => {
            reconstruirAmbosSelects();

            // Asignar eventos luego de inicializar
            document.getElementById("tipo1").addEventListener("change", () => {
                reconstruirAmbosSelects();
            });
            document.getElementById("tipo2").addEventListener("change", () => {
                reconstruirAmbosSelects();
            });
        });
    </script>

<?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
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
    <link rel="stylesheet" href="\Creatura_PHP\styles\editar_creatura.css">
</head>
<body>
    <?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Creatura</div>
        <button onclick="history.back();">Cancelar</button>
    </div>
</div>
<form id="formAltaCreatura" action="/Creatura_PHP/procesamiento/manejar_modificacionCreatura.php?id_creatura=<?php echo $informacion_creatura['id_creatura']?>&creador=<?php echo $informacion_creatura['creador']?>&nombre_creatura=<?php echo $informacion_creatura['nombre_creatura']?>" method="POST" enctype="multipart/form-data">
    <div class="guardar">
        <button type="submit">Guardar Cambios</button>
    </div>
    <div class="contenido-creatura">
        <div class="imagen">
            <p>Nueva Imagen de la Creatura:</p>
            <input name="imagen" type="file" accept="image/png, image/jpeg" id="imagenInput">
            <img id="creaturaImage" src="/Creatura_PHP/imagenes/creaturas/<?php echo $informacion_creatura['imagen']; ?>">
        </div>
        <div class="info-creatura">
            <div class="visibilidad">
                <div>
                    <select id="publico" name="publico" required>
                        <option value="">Selecciona Visiblidad</option>
                        <option value="1" <?= ($informacion_creatura['publico'] == 1) ? 'selected' : '' ?>>Mantener Pública</option>
                        <option value="0" <?= ($informacion_creatura['publico'] == 0) ? 'selected' : '' ?>>Mantener Privada</option>
                    </select>
                </div>
            </div>
            <div class="info">
                <p>Nombre</p>
                <input name="nombre" type="text" maxlength="30" value="<?= htmlspecialchars($informacion_creatura['nombre_creatura']) ?>" required>

                <p>Descripción</p>
                <input name="descripcion" type="text" maxlength="200" value="<?= htmlspecialchars($informacion_creatura['descripcion']) ?>">
            </div>
            <div class="tipos">
                <div>
                    <p>Tipo 1</p>
                    <select name="tipo1" id="tipo1" onchange="reconstruirSelects('tipo1')" required>
                        <?php foreach ($lista_tipos as $tipo): ?>
                            <option value="<?= $tipo['id_tipo'] ?>" <?= $tipo['id_tipo'] == $informacion_creatura['id_tipo1'] ? 'selected' : '' ?> style="background-color: #<?= htmlspecialchars($tipo['color']) ?>;">
                                <?= htmlspecialchars($tipo['nombre_tipo']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <p>Tipo 2</p>
                    <select name="tipo2" id="tipo2" onchange="reconstruirSelects('tipo2')">
                        <?php foreach ($lista_tipos as $tipo): ?>
                            <option value="<?= $tipo['id_tipo'] ?>" <?= $tipo['id_tipo'] == $informacion_creatura['id_tipo2'] ? 'selected' : '' ?> style="background-color: #<?= htmlspecialchars($tipo['color']) ?>;">
                                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="stats">
                <div>
                    <p>HP</p>
                    <input id="hp_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['hp'] ?>" oninput="sincronizarSlider(this, 'hp')">
                </div>
                <input class="barra-stat" name="hp" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['hp'] ?>" oninput="sincronizarValor(this, 'hp_val')">

                <div>
                    <p>ATK</p>
                    <input id="atk_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['atk'] ?>" oninput="sincronizarSlider(this, 'atk')">
                </div>
                <input class="barra-stat" name="atk" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['atk'] ?>" oninput="sincronizarValor(this, 'atk_val')">
                
                <div>
                    <p>DEF</p>
                    <input id="def_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['def'] ?>" oninput="sincronizarSlider(this, 'def')">
                </div>
                <input class="barra-stat" name="def" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['def'] ?>" oninput="sincronizarValor(this, 'def_val')">
                
                <div>
                    <p>SPA</p>
                    <input id="spa_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['spa'] ?>" oninput="sincronizarSlider(this, 'spa')">
                </div>
                <input class="barra-stat" name="spa" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['spa'] ?>" oninput="sincronizarValor(this, 'spa_val')">
                
                <div>
                    <p>SDEF</p>
                    <input id="spdef_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['sdef'] ?>" oninput="sincronizarSlider(this, 'spdef')">
                </div>
                <input class="barra-stat" name="spdef" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['sdef'] ?>" oninput="sincronizarValor(this, 'spdef_val')">
                
                <div>
                    <p>SPE</p>
                    <input id="spe_val" type="number" min="1" max="255" value="<?= (int)$informacion_creatura['spe'] ?>" oninput="sincronizarSlider(this, 'spe')">
                </div>
                <input class="barra-stat" name="spe" type="range" min="1" max="255" value="<?= (int)$informacion_creatura['spe'] ?>" oninput="sincronizarValor(this, 'spe_val')">
            </div>

            <?php
            $lista_tipos_habilidad = $controladorTipo->listar_tipos();
            ?>
        </div>
    </div>



    <div class="cont-titular"> 
        <div class="titular">
            <div>Habilidades de la Creatura</div>
        </div>
    </div>

    <div class="cont-mini-titular"> 
        <div class="mini-titular">
            <div>Disponibles</div>
        </div>
    </div>
    <div class="selector-tipo">
        <label for="filtroTipoHabilidad">Filtrar por tipo</label>
        <select id="filtroTipoHabilidad" onchange="retornarHabilidades(this.value)">
            <option value="">Selecciona un tipo</option>
            <?php foreach ($lista_tipos_habilidad as $tipo): ?>
                <option value="<?= $tipo['id_tipo'] ?>" style="background-color: #<?= htmlspecialchars($tipo['color']) ?>;">
                    <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="habilidades agregar">
        <table id="tablaHabilidades">
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
    </div>

    <div class="cont-mini-titular"> 
        <div class="mini-titular">
            <div>Seleccionadas</div>
        </div>
    </div>
    <div class="habilidades quitar">
        <table id="tablaSeleccionadas">
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
    </div>

    <input type="hidden" name="habilidades_json" id="habilidades_json">
</form>

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

    const tbodySel = document.querySelector("#tablaSeleccionadas tbody");
    tbodySel.addEventListener("click", function (e) {
        if (e.target.matches("button[data-id]")) {
            const id = e.target.getAttribute("data-id");
            eliminarHabilidad(id);   // quita del array y vuelve a pintar
        }
    });
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
                tdNombre.style.backgroundColor = color;

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
    const index = habilidadesSeleccionadas.findIndex(h => h.id == id); // Comparación flexible
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
                <td style="background-color: ${hab.color};">${hab.nombre}</td>
            <td>${hab.descripcion}</td>
            <td>${hab.categoria}</td>
            <td>${hab.potencia}</td>
            <td><button type="button" data-id="${hab.id}">Quitar</button></td>
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

        document.getElementById('imagenInput').addEventListener('change', function(event) {
                    const file = event.target.files[0];

                    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            document.getElementById('creaturaImage').src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                    }
                });
    </script>

<?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
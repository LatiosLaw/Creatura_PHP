<?php

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$lista_tipos = $controladorTipo->listar_tipos();
$lista_tipos_habilidad = $controladorTipo->listar_tipos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Creatura</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\alta_creatura.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>

<?php include_once("../piezas_html/cabecera.php"); ?>

<div class="cont-titular"> 
    <div class="titular">
        <div>Creatura</div>
        <button onclick="history.back();">Cancelar</button>
    </div>
</div>
<form id="formAltaCreatura" action="../procesamiento/manejar_altaCreatura.php" method="POST" enctype="multipart/form-data">
    <div class="guardar">
        <button type="submit">Confirmar Creación</button>
    </div>
    <div class="contenido-creatura">
        <div class="imagen">
            <p>Imagen de la Creatura:</p>
            <input name="imagen" type="file" accept="image/png, image/jpeg" id="imagenInput">
            <img id="creaturaImage" src="../imagenes/sin_imagen.png">
        </div>
        <div class="info-creatura">
            <div class="visibilidad">
                <div>
                    <select name="publico" id="publico" required>
                        <option value="">Selecciona Visiblidad</option>
                        <option value="1">Dejar Pública</option>
                        <option value="0">Dejar Privada</option>
                    </select>
                </div>
            </div>
            <div class="info">
                <p>Nombre</p>
                <input name="nombre" type="text" required>

                <p>Descripción</p>
                <input name="descripcion" type="text">
            </div>
            <div class="tipos">
                <div>
                    <p>Tipo 1</p>
                    <select name="tipo1" id="tipo1" onchange="reconstruirSelects('tipo1')" required></select>
                </div>
                <div>
                    <p>Tipo 2 (Opcional)</p>
                    <select name="tipo2" id="tipo2" onchange="reconstruirSelects('tipo2')"></select>
                </div>
            </div>
            <div class="stats">
                <div>
                    <p>HP</p>
                    <input id="hp_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'hp')">
                </div>
                <input class="barra-stat" name="hp" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'hp_val')">

                <div>
                    <p>ATK</p>
                    <input id="atk_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'atk')">
                </div>
                <input class="barra-stat" name="atk" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'atk_val')">

                <div>
                    <p>DEF</p>
                    <input id="def_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'def')">
                </div>
                <input class="barra-stat" name="def" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'def_val')">

                <div>
                    <p>SPA</p>
                    <input id="spa_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'spa')">
                </div>
                <input class="barra-stat" name="spa" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'spa_val')">

                <div>
                    <p>SDEF</p>
                    <input id="spdef_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'spdef')">
                </div>
                <input class="barra-stat" name="spdef" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'spdef_val')">

                <div>
                    <p>SPE</p>
                    <input id="spe_val" type="number" min="1" max="255" value="70" oninput="sincronizarSlider(this, 'spe')">
                </div>
                <input class="barra-stat" name="spe" type="range" min="1" max="255" value="70" oninput="sincronizarValor(this, 'spe_val')">
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
        <label for="filtroTipoHabilidad">Filtrar por tipo </label>
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

        <?php include_once("../piezas_html/pie_pagina.php"); ?>

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

        const habilidadesSeleccionadas = [];

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

                        tr.innerHTML = `
        <td>${hab.id_habilidad}</td>
                        <td style="background-color: ${color};"><div><img src="/Creatura_PHP/imagenes/tipos/${hab.icono_tipo_habilidad}">${hab.nombre_habilidad}</div></td>
        <td>${hab.descripcion}</td>
        <td>${hab.categoria_habilidad}</td>
        <td>${hab.potencia}</td>
        <td><button type="button" onclick="agregarHabilidad(${hab.id_habilidad}, '${hab.nombre_habilidad}', '${hab.descripcion}', '${hab.categoria_habilidad}', ${hab.potencia}, '${color}', '${hab.icono_tipo_habilidad}')">Agregar</button></td>
    `;

                        tbody.appendChild(tr);
                    });
                })
                .catch(err => console.error("Error al cargar habilidades:", err));
        }

        function agregarHabilidad(id, nombre, descripcion, categoria, potencia, color, icono) {
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
                color,
                icono
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
                <td style="background-color: ${hab.color};"><div><img src="/Creatura_PHP/imagenes/tipos/${hab.icono}">${hab.nombre}</div></td>
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
            select.innerHTML = '<option value="">Selecciona un tipo</option><option value="">-</option>';
            tipos.forEach(tipo => {
                if (tipo.id_tipo != excluir) {
                    const option = document.createElement("option");
                    option.value = tipo.id_tipo;
                    option.textContent = tipo.nombre_tipo;
                    option.style.backgroundColor = `#${tipo.color}`;
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
    
</body>
</html>
<?php

include_once("../clases/conexion.php");
$controladorConexion = new Conexion();
$conexion = $controladorConexion->conectar();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$lista_tipos = $controladorTipo->listar_tipos($conexion);
$lista_tipos_habilidad = $controladorTipo->listar_tipos($conexion);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJEMPLO - ALTA CREATURA</title>
</head>

<body>

    <a href="../index.php"><button>Regresar</button></a>

    <?php
    session_start();

    if (isset($_SESSION['nickname'])) { ?>
        <div>
            <form id="formAltaCreatura" action="../procesamiento/manejar_altaCreatura.php" method="POST">
                Nombre <input name="nombre" type="text"><br>
                TIPO 1
                <select name="tipo1" id="tipo1" onchange="reconstruirSelects('tipo1')"></select><br>


                TIPO 2
                <select name="tipo2" id="tipo2" onchange="reconstruirSelects('tipo2')"></select><br>


                Imagen <input name="imagen" type="file" accept="image/png, image/jpeg"><br>

                HP
                <input name="hp" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'hp_val')">
                <span id="hp_val">70</span><br>

                ATK
                <input name="atk" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'atk_val')">
                <span id="atk_val">70</span><br>

                DEF
                <input name="def" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'def_val')">
                <span id="def_val">70</span><br>

                SPA
                <input name="spa" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'spa_val')">
                <span id="spa_val">70</span><br>

                SPDEF
                <input name="spdef" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'spdef_val')">
                <span id="spdef_val">70</span><br>

                SPE
                <input name="spe" type="range" min="1" max="255" value="70" oninput="actualizarValor(this, 'spe_val')">
                <span id="spe_val">70</span><br>


                Descripcion <input name="descripcion" type="text">

                <?php
                $lista_tipos_habilidad = $controladorTipo->listar_tipos($conexion);
                ?>

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
    <?php
    } else {
        echo "<p>Necesitas iniciar sesión para utilizar esta función.</p>";
    }
    ?>

    <script>
        const tipos = <?= json_encode($lista_tipos) ?>;

        function actualizarValor(slider, spanId) {
            document.getElementById(spanId).textContent = slider.value;
        }

        function obtenerColorTipo(id_tipo) {
            const tipo = tipos.find(t => t.id_tipo == id_tipo);
            return tipo ? `#${tipo.color}` : '#000000'; // negro si no se encuentra
        }

        const habilidadesSeleccionadas = [];

        function retornarHabilidades(id_tipo) {
            if (!id_tipo) return;

            fetch(`../procesamiento/obtener_habilidades_tipo.php?id_tipo=${id_tipo}`)
                .then(res => res.json())
                .then(habilidades => {
                    const tbody = document.querySelector("#tablaHabilidades tbody");
                    tbody.innerHTML = "";

                    habilidades.forEach(hab => {
                        const color = obtenerColorTipo(hab.id_tipo_habilidad);
                        const tr = document.createElement("tr");

                        tr.innerHTML = `
        <td style="color: ${color};">${hab.nombre_habilidad}</td>
        <td>${hab.descripcion}</td>
        <td>${hab.categoria_habilidad}</td>
        <td>${hab.potencia}</td>
        <td><button type="button" onclick="agregarHabilidad(${hab.id_habilidad}, '${hab.nombre_habilidad}', '${hab.descripcion}', '${hab.categoria_habilidad}', ${hab.potencia}, '${color}')">Agregar</button></td>
    `;

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

</body>

</html>
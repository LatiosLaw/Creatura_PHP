<?php

include_once("../clases/conexion.php");
include_once("../clases/tipo.php");
include_once("../clases/creatura.php");
include_once("../clases/usuario.php");

$controladorConexion = new Conexion();
$controladorCreatura = new Creatura();
$controladorUsuario = new Usuario();
$controladorTipo = new Tipo();
$conexion = $controladorConexion->conectar();

$tipos = $controladorTipo->listar_tipos($conexion);
$usuarios = $controladorUsuario->listar_usuarios($conexion);
$creaturas = $controladorCreatura->listar_creaturas($conexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEARCHING GROUNDS</title>
</head>

<body>

    <a href="../index.php"><button>Regresar</button></a>

    <h2>Selecciona un tipo</h2>
    <select id="tipo-select">
        <option value="">-- Elige un tipo --</option>
        <?php foreach ($tipos as $tipo): ?>
            <option value="<?= $tipo['id_tipo'] ?>"
                data-nombre="<?= htmlspecialchars($tipo['nombre_tipo']) ?>"
                data-icono="<?= htmlspecialchars($tipo['icono']) ?>"
                data-color="<?= htmlspecialchars($tipo['color']) ?>" style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h3>Habilidades del tipo seleccionado</h3>
    <table border="1" id="habilidades-tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Categoría</th>
                <th>Potencia</th>
                <th>Descripción</th>
                <th>Creador</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se insertarán las habilidades -->
        </tbody>
    </table>

    <h2>Buscar usuario</h2>
    <select id="usuario-select">
        <option value="">-- Selecciona un usuario --</option>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?= htmlspecialchars($usuario['nickname']) ?>">
                <?= htmlspecialchars($usuario['nickname']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div id="info-usuario"></div>
    <div id="tabla-creaturas"></div>

    <h1>Selecciona una Creatura</h1>
    <select id="select_creatura" onchange="cargarInformacionCreatura()">
        <option disabled selected>-- Elige una --</option>
        <?php while ($c = mysqli_fetch_assoc($creaturas)): ?>
            <option value="<?= htmlspecialchars($c['nombre_creatura']) ?>" data-creador="<?= htmlspecialchars($c['creador']) ?>">
                <?= htmlspecialchars($c['nombre_creatura']) ?> (<?= htmlspecialchars($c['creador']) ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <div id="info_creatura"></div>
    <div id="habilidades_creatura"></div>
    <div id="interacciones_creatura"></div>

    <script>
        document.getElementById("tipo-select").addEventListener("change", function() {
            const select = this;
            const idTipo = select.value;
            const tipoNombre = select.options[select.selectedIndex].getAttribute("data-nombre");
            const tipoColor = select.options[select.selectedIndex].getAttribute("data-color");
            const tipoIcono = select.options[select.selectedIndex].getAttribute("data-icono");
            const tbody = document.querySelector("#habilidades-tabla tbody");
            tbody.innerHTML = "";

            if (idTipo) {
                fetch(`../procesamiento/dinamico/obtener_habilidades_tipo.php?id_tipo=${idTipo}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach(habilidad => {
                                const fila = document.createElement("tr");

                                fila.innerHTML = `
                                <td>${habilidad.nombre_habilidad}</td>
                                <td style="padding-top:10px; padding-bottom:10px; background-color: #${tipoColor}; color: #fff; display: flex; align-items: center; gap: 5px;">
    <img src="../imagenes/tipos/${tipoIcono}" width="20" height="20" onerror="this.style.display='none';">
    ${tipoNombre}
</td>

                                <td>${habilidad.categoria_habilidad}</td>
                                <td>${habilidad.potencia}</td>
                                <td>${habilidad.descripcion}</td>
                                <td>${habilidad.creador}</td>
                            `;
                                tbody.appendChild(fila);
                            });
                        } else {
                            const fila = document.createElement("tr");
                            fila.innerHTML = `<td colspan="6">No hay habilidades para este tipo.</td>`;
                            tbody.appendChild(fila);
                        }
                    })
                    .catch(error => {
                        console.error("Error al obtener habilidades:", error);
                        const fila = document.createElement("tr");
                        fila.innerHTML = `<td colspan="6">Error al cargar habilidades.</td>`;
                        tbody.appendChild(fila);
                    });
            }
        });

        document.getElementById("usuario-select").addEventListener("change", function() {
            const nickname = this.value;
            const infoDiv = document.getElementById("info-usuario");
            const tablaDiv = document.getElementById("tabla-creaturas");

            infoDiv.innerHTML = "";
            tablaDiv.innerHTML = "";

            if (!nickname) return;

            fetch(`../procesamiento/dinamico/obtener_usuario.php?nickname=${nickname}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        infoDiv.innerHTML = `<p>Error: ${data.error}</p>`;
                        return;
                    }

                    const usuario = data.usuario;
                    const creaturas = data.creaturas;

                    // Mostrar información del usuario
                    infoDiv.innerHTML = `
                    <h2>${usuario.nickname}</h2>
                    <img src="../imagenes/usuarios/${usuario.foto}" alt="Foto de perfil" width="150">
                    <p><strong>Correo:</strong> ${usuario.correo}</p>
                    <p><strong>Biografía:</strong> ${usuario.biografia}</p>
                `;

                    if (creaturas.length === 0) {
                        tablaDiv.innerHTML = "<p>No tiene criaturas registradas.</p>";
                        return;
                    }

                    let tablaHTML = `
                    <h3>Criaturas de ${usuario.nickname}</h3>
                    <table border="1" cellpadding="4" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo 1</th>
                                <th>Tipo 2</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                    creaturas.forEach(c => {
                        const tipo1 = c.tipo1;
                        const tipo2 = c.tipo2;

                        tablaHTML += `
                        <tr>
                            <td>${c.nombre}</td>
                            <td style="background-color:#${tipo1.color};color:#fff;">
                                ${tipo1.nombre_tipo}
                            </td>
                            <td style="background-color:#${tipo2.color};color:#fff;">
                                ${tipo2.nombre_tipo}
                            </td>
                        </tr>
                    `;
                    });

                    tablaHTML += "</tbody></table>";
                    tablaDiv.innerHTML = tablaHTML;
                })
                .catch(err => {
                    infoDiv.innerHTML = `<p>Error de conexión: ${err.message}</p>`;
                });
        });

        function cargarInformacionCreatura() {
            const nombre = document.getElementById("select_creatura").value;
            const creador = document.getElementById("select_creatura").selectedOptions[0].dataset.creador;

            fetch(`../procesamiento/dinamico/obtener_creatura.php?nombre=${encodeURIComponent(nombre)}&creador=${encodeURIComponent(creador)}`)
                .then(res => res.json())
                .then(data => {
                    const c = data.creatura;
                    const habilidades = data.habilidades;
                    const t = data.tipos;
                    const interacciones = data.interacciones;

                    // --- Tipos HTML ---
                    let tiposHTML = '';
                    if (t.tipo1) {
                        tiposHTML += `
<span style="background-color: #${t.tipo1.color}; padding: 4px 8px; border-radius: 8px; color: white; margin-right: 8px; display: inline-block;">
    <img src="../imagenes/tipos/${t.tipo1.icono}" alt="${t.tipo1.nombre_tipo}" width="20" style="vertical-align: middle; margin-right: 4px;">
    ${t.tipo1.nombre_tipo}
</span>`;
                    }
                    if (t.tipo2) {
                        tiposHTML += `
<span style="background-color: #${t.tipo2.color}; padding: 4px 8px; border-radius: 8px; color: white; margin-right: 8px; display: inline-block;">
    <img src="../imagenes/tipos/${t.tipo2.icono}" alt="${t.tipo2.nombre_tipo}" width="20" style="vertical-align: middle; margin-right: 4px;">
    ${t.tipo2.nombre_tipo}
</span>`;
                    }

                    // --- Info general ---
                    document.getElementById("info_creatura").innerHTML = `
<h2>${c.nombre_creatura}</h2>
<img 
    src="../imagenes/creaturas/${c.imagen}" 
    alt="${c.nombre_creatura}" 
    width="200" 
    onerror="this.onerror=null; this.src='../imagenes/creaturas/CREATURA_DEFAULT.png';"
/><br>
<p><strong>Descripción:</strong> ${c.descripcion}</p>
<p><strong>Tipos:</strong><br>${tiposHTML}</p>
<p><strong>HP:</strong> ${c.hp} | <strong>ATK:</strong> ${c.atk} | <strong>DEF:</strong> ${c.def}</p>
<p><strong>SPA:</strong> ${c.spa} | <strong>SDEF:</strong> ${c.sdef} | <strong>SPE:</strong> ${c.spe}</p>
<p><strong>Rating Promedio:</strong> ${c.rating_promedio ?? 'Sin valoraciones'}/5</p>`;

                    // --- Habilidades ---
                    let tabla = `<table border="1" cellpadding="4" cellspacing="0">
<thead><tr>
    <th>Nombre</th>
    <th>Tipo</th>
    <th>Categoría</th>
    <th>Potencia</th>
    <th>Descripción</th>
    <th>Creador</th>
</tr></thead><tbody>`;

                    for (let h of habilidades) {
                        tabla += `
<tr>
    <td>${h.nombre_habilidad}</td>
    <td>
        <span style="background-color: #${h.color_tipo_habilidad}; padding: 4px 8px; border-radius: 8px; color: white; display: inline-block;">
            <img src="../imagenes/tipos/${h.icono_tipo_habilidad}" alt="${h.nombre_tipo_habilidad}" width="20" style="vertical-align: middle; margin-right: 4px;">
            ${h.nombre_tipo_habilidad}
        </span>
    </td>
    <td>${h.categoria_habilidad}</td>
    <td>${h.potencia}</td>
    <td>${h.descripcion}</td>
    <td>${h.creador}</td>
</tr>`;
                    }

                    tabla += "</tbody></table>";
                    document.getElementById("habilidades_creatura").innerHTML = tabla;

                    // --- Interacciones Defensivas ---
                    const categorias = {
                        'Muy débil (x4)': [],
                        'Débil (x2)': [],
                        'Neutro (x1)': [],
                        'Resistente (x0.5)': [],
                        'Muy resistente (x0.25)': [],
                        'Inmune (x0)': []
                    };

                    for (let tipo of interacciones) {
                        switch (tipo.multiplicador) {
                            case 0:
                                categorias['Inmune (x0)'].push(tipo);
                                break;
                            case 0.25:
                                categorias['Muy resistente (x0.25)'].push(tipo);
                                break;
                            case 0.5:
                                categorias['Resistente (x0.5)'].push(tipo);
                                break;
                            case 1:
                                categorias['Neutro (x1)'].push(tipo);
                                break;
                            case 2:
                                categorias['Débil (x2)'].push(tipo);
                                break;
                            case 4:
                                categorias['Muy débil (x4)'].push(tipo);
                                break;
                            default:
                                categorias['Neutro (x1)'].push(tipo);
                        }
                    }

                    let interaccionesHTML = "<h2>Interacciones defensivas</h2>";

                    for (let [titulo, tipos] of Object.entries(categorias)) {
                        if (tipos.length === 0) continue;

                        interaccionesHTML += `<h3>${titulo}</h3><div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1em;">`;

                        for (let tipo of tipos) {
                            interaccionesHTML += `
<div style="padding: 8px; background-color: #${tipo.color}; border-radius: 5px; color: white; min-width: 100px; text-align: center;">
    <img src="../imagenes/tipos/${tipo.icono}" alt="${tipo.nombre_tipo}" width="20" style="vertical-align: middle; margin-bottom: 4px;"><br>
    ${tipo.nombre_tipo}<br>x${tipo.multiplicador}
</div>`;
                        }

                        interaccionesHTML += "</div>";
                    }

                    document.getElementById("interacciones_creatura").innerHTML = interaccionesHTML;
                });
        }
    </script>
</body>

</html>
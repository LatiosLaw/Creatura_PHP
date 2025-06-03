<?php

include_once("../clases/conexion.php");
$controladorConexion = new Conexion();
$conexion = $controladorConexion->conectar();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

$lista_tipos = $controladorTipo->listar_tipos($conexion);

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
    <select name="tipo1" id="tipo1" onchange="actualizarTipo2()">
        <option value="">Selecciona un primer tipo</option>
        <?php foreach ($lista_tipos as $tipo): ?>
            <option value="<?= $tipo['id_tipo'] ?>" style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    TIPO 2 
    <select name="tipo2" id="tipo2" onchange="actualizarTipo1()">
        <option value="">Selecciona un segundo tipo</option>
        <?php foreach ($lista_tipos as $tipo): ?>
            <option value="<?= $tipo['id_tipo'] ?>" style="color: #<?= htmlspecialchars($tipo['color']) ?>;">
                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>


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


                Descripcion <input name="descripcion" type="text"><br>
                <input type="submit">
            </form>
        </div>
    <?php
    } else {
        echo "<p>Necesitas iniciar sesión para utilizar esta función.</p>";
    }
    ?>

   <script>
function actualizarValor(slider, spanId) {
    document.getElementById(spanId).textContent = slider.value;
}

function actualizarTipo1() {
    const tipo2 = document.getElementById("tipo2").value;
    const tipo1Select = document.getElementById("tipo1");

    for (let option of tipo1Select.options) {
        option.disabled = (option.value === tipo2 && tipo2 !== "");
    }
}

function actualizarTipo2() {
    const tipo1 = document.getElementById("tipo1").value;
    const tipo2Select = document.getElementById("tipo2");

    for (let option of tipo2Select.options) {
        option.disabled = (option.value === tipo1 && tipo1 !== "");
    }
}

</script>

</body>
</html>
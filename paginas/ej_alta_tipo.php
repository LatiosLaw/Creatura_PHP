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
    <title>EJEMPLO - ALTA TIPO</title>
</head>
<body>
    
<a href="../index.php"><button>Regresar</button></a>

<?php
session_start();

if (isset($_SESSION['nickname'])) { ?>
<div><p><form action="../procesamiento/manejar_altaTipo.php" method="POST" enctype="multipart/form-data">
    Nombre <input name="nombre" type="text"><br>
            Color <input name="color" type="color"><br>
            Icono del Tipo <input name="icono" type="file" accept="image/png, image/jpeg"><br>

            <table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Relación</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista_tipos as $tipo): ?>
        <tr>
            <td style="color: #<?= htmlspecialchars($tipo['color']) ?>;"><?= htmlspecialchars($tipo['nombre_tipo']) ?></td>
            <td>
                <select name="relacion_<?= $tipo['id_tipo'] ?>">
                    <option value="1" selected>Neutro (x1)</option>
                    <option value="2">Debilidad (x2)</option>
                    <option value="0.5">Resistencia (x0.5)</option>
                    <option value="0">Inmunidad (x0)</option>
                </select>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            <input type="submit">
</form></p></div>
<?php
} else {
    echo "<p>Necesitas iniciar sesión para utilizar esta función.</p>";
}
?>

</body>
</html>
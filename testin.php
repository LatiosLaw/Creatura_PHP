<?php

include_once("./clases/conexion.php");
include_once("./clases/tipo.php");
include_once("./clases/creatura.php");
include_once("./clases/usuario.php");

$controladorConexion = new Conexion();
$controladorCreatura = new Creatura();
$controladorUsuario = new Usuario();
$controladorTipo = new Tipo();
$conexion = $controladorConexion->conectar();

$creaturas = $controladorCreatura->listar_creaturas_ext($conexion, 20, null);
$usuarios = $controladorUsuario->listar_usuarios($conexion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTING GROUNDS</title>
</head>
<body>

    <div><h1>Listado de Creaturas (Limitado a 20)</h1>
    <table border="1" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo 1</th>
                <th>Tipo 2</th>
                <th>Descripción</th>
                <th>HP</th>
                <th>ATK</th>
                <th>DEF</th>
                <th>SPA</th>
                <th>SDEF</th>
                <th>SPE</th>
                <th>Creador</th>
                <th>Imagen</th>
                <th>Público</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($creaturas)) : 
                
                $tipo1 = $controladorTipo->retornar_tipo($conexion, $fila['id_tipo1']);
                $tipo2 = $controladorTipo->retornar_tipo($conexion, $fila['id_tipo2'])
                
            ?>
                <tr>
                    <td><?= $fila['id_creatura'] ?></td>
                    <td><?= htmlspecialchars($fila['nombre_creatura']) ?></td>
                    <td style="background-color: #<?= $tipo1['color']; ?>; color: #fff;">
                    <?= $tipo1['nombre_tipo']; ?>
                    </td>
                    <td style="background-color: #<?= $tipo2['color']; ?>; color: #fff;">
                    <?= $tipo2['nombre_tipo']; ?>
                    </td>
                    <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                    <td><?= $fila['hp'] ?></td>
                    <td><?= $fila['atk'] ?></td>
                    <td><?= $fila['def'] ?></td>
                    <td><?= $fila['spa'] ?></td>
                    <td><?= $fila['sdef'] ?></td>
                    <td><?= $fila['spe'] ?></td>
                    <td><?= htmlspecialchars($fila['creador']) ?></td>
                    <td><img src="./imagenes/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='./imagenes/sin_imagen.png';"></td>
                    <td><?= $fila['publico'] == 1 ? "Sí" : "No" ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table></div>

    <div><h1>Listado de Usuarios</h1>
    <table border="1" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th>Nickname</th>
                <th>Imagen</th>
                <th>Biografia</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($usuarios)) : ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nickname']) ?></td>
                    <td><img src="./imagenes/<?= htmlspecialchars($fila['foto']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='./imagenes/sin_imagen.png';"></td>
                    <td><?= $fila['biografia']?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table></div>

<?php
$creatura_elegida = $controladorCreatura->retornar_creatura("Waifumancer", "AnimeTank47", $conexion);
if($creatura_elegida!=false){
$habilidades = $controladorCreatura->retornar_habilidades($creatura_elegida['id_creatura'], $conexion);
$tipo1_elegida = $controladorTipo->retornar_tipo($conexion, $creatura_elegida['id_tipo1']);
$tipo2_elegida = $controladorTipo->retornar_tipo($conexion, $creatura_elegida['id_tipo2']);      

$efectividades = $controladorCreatura->retornar_calculo_de_tipos_defendiendo($tipo1_elegida['id_tipo'], $tipo2_elegida['id_tipo'], $conexion);
}
?>

    <div>
    <h1>Información de la Creatura</h1>
    <div style="display: flex; gap: 20px;">
        <img src="./imagenes/<?= htmlspecialchars($creatura_elegida['imagen']) ?>" alt="Imagen de la creatura" width="200" onerror="this.onerror=null; this.src='./imagenes/sin_imagen.png';">
        <div>
            <h2><?= htmlspecialchars($creatura_elegida['nombre_creatura']) ?></h2>
            <p><strong>Creador:</strong> <?= htmlspecialchars($creatura_elegida['creador']) ?></p>
            <p>
            <div style="background-color: #<?= $tipo1_elegida['color']; ?>; color: #fff;"><?= $tipo1_elegida['nombre_tipo']; ?></div>
            <div style="background-color: #<?= $tipo2_elegida['color']; ?>; color: #fff;"><?= $tipo2_elegida['nombre_tipo']; ?></div>
            </p>

            <p><strong>Descripción:</strong> <?= htmlspecialchars($creatura_elegida['descripcion']) ?></p>
            <p><strong>Stats:</strong><br>
                HP: <?= $creatura_elegida['hp'] ?> |
                ATK: <?= $creatura_elegida['atk'] ?> |
                DEF: <?= $creatura_elegida['def'] ?> |
                SPA: <?= $creatura_elegida['spa'] ?> |
                SDEF: <?= $creatura_elegida['sdef'] ?> |
                SPE: <?= $creatura_elegida['spe'] ?>
            </p>
        </div>
    </div>
</div>

<hr>

<div>
    <h2>Habilidades que aprende</h2>
    <?php if (count($habilidades) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
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
                <?php foreach ($habilidades as $habilidad): ?>
                    <?php $tipo = $controladorTipo->retornar_tipo($conexion, $habilidad['id_tipo_habilidad']); ?>
                    <tr>
                        <td><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></td>
                        <td style="background-color: #<?= $tipo['color'] ?>; color: #fff;">
                            <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                        </td>
                        <td><?= htmlspecialchars($habilidad['categoria_habilidad']) ?></td>
                        <td><?= $habilidad['potencia'] ?></td>
                        <td><?= htmlspecialchars($habilidad['descripcion']) ?></td>
                        <td><?= htmlspecialchars($habilidad['creador']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Esta creatura aún no tiene habilidades registradas.</p>
    <?php endif; ?>
</div>

<hr>

<div>
    <h2>Interacciones defensivas</h2>

    <?php
    // CATEGORIAS - basicamente un array para mostrar cosas después
    $categorias = [
        'Muy débil (x4)' => [],
        'Débil (x2)' => [],
        'Neutro (x1)' => [],
        'Resistente (x0.5)' => [],
        'Muy resistente (x0.25)' => [],
        'Inmune (x0)' => []
    ];

    foreach ($efectividades as $tipo) { 
        switch ($tipo['multiplicador']) { //ME ACORDE DE QUE CASE EXISTE YIPPEEEE
            case 0:
                $categorias['Inmune (x0)'][] = $tipo;
                break;
            case 0.25:
                $categorias['Muy resistente (x0.25)'][] = $tipo;
                break;
            case 0.5:
                $categorias['Resistente (x0.5)'][] = $tipo;
                break;
            case 1:
                $categorias['Neutro (x1)'][] = $tipo;
                break;
            case 2:
                $categorias['Débil (x2)'][] = $tipo;
                break;
            case 4:
                $categorias['Muy débil (x4)'][] = $tipo;
                break;
            default:
                $categorias['Neutro (x1)'][] = $tipo;
        }
    }

    // La lista final
    foreach ($categorias as $titulo => $tipos) {
        if (count($tipos) === 0) continue;

        echo "<h3>$titulo</h3><div style='display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1em;'>";

        foreach ($tipos as $tipo) {
            echo "<div style='padding: 8px; background-color: #{$tipo['color']}; border-radius: 5px; color: white; min-width: 100px; text-align: center;'>
                    {$tipo['nombre_tipo']}<br>x{$tipo['multiplicador']}
                </div>";
        }

        echo "</div>";
    }
    ?>
</div>
</div>

<?php

$usuario_elegido = $controladorUsuario->retornar_usuario("WeirdAniki7963", $conexion);

?>

<div></div>

<?php // TO DO : 

//Información de Usuario con sus creaturas
//Información de un tipo con sus matchups ofensivos
//Mostrar ataques de un tipo
//Mostrar ratings de una creatura

?>
        
</body>
</html>
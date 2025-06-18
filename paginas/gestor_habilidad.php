<?php
include_once("../piezas_html/cabecera.php");

if (isset($_SESSION['nickname'])) {
    $nickname_sesion = $_SESSION['nickname'];
}

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$habilidades_usuario = $controladorCreatura->retornar_habilidades_creador($nickname_sesion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Habilidades</title>
</head>
<body>
    
    <button onclick="history.back();">Volver</button>

    <div>
        <h2>Tus Habilidades</h2>
        <button onclick="window.location.href = '/Creatura_PHP/paginas/alta_habilidad.php';">Crear Habilidad</button>
        <?php if (count($habilidades_usuario) > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Categoría</th>
                        <th>Potencia</th>
                        <th>Descripción</th>
                        <th>Creador</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($habilidades_usuario as $habilidad): ?>
                        <?php $tipo = $controladorTipo->retornar_tipo($habilidad['id_tipo_habilidad']); ?>
                        <tr>
                            <td><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></td>
                            <td style="background-color: #<?= $tipo['color'] ?>; color: #fff;">
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo['nombre_tipo']) ?>&creador=<?= urlencode($tipo['creador']) ?>&id_tipo=<?= urlencode($tipo['id_tipo']) ?>'>
                                <?= htmlspecialchars($tipo['nombre_tipo']) ?>
                            </a></td>
                            <td><?= htmlspecialchars($habilidad['categoria_habilidad']) ?></td>
                            <td><?= $habilidad['potencia'] ?></td>
                            <td><?= htmlspecialchars($habilidad['descripcion']) ?></td>
                            <td><?= htmlspecialchars($habilidad['creador']) ?></td>
                            <td>
  <select onchange="manejarAccion(
        this.value,
        '<?= htmlspecialchars($habilidad['nombre_habilidad'], ENT_QUOTES) ?>',
        '<?= htmlspecialchars($habilidad['id_habilidad'],   ENT_QUOTES) ?>'
      )">
    <option value="">-- Acciones --</option>
    <option value="ver">Ver</option>
    <option value="editar">Editar</option>
    <option value="eliminar">Eliminar</option>
  </select>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Esta creatura aún no tiene habilidades registradas.</p>
        <?php endif; ?>
    </div>

    <?php include_once("../piezas_html/pie_pagina.php"); ?>

<script>
  function manejarAccion(accion, nombreHabilidad, idHabilidad) {
    if (!accion) return;

    switch (accion) {
      case 'ver':
        window.location.href = `/Creatura_PHP/paginas/ver_habilidad.php?nombre_habilidad=${encodeURIComponent(nombreHabilidad)}&creador=<?= urlencode($_SESSION['nickname'])?>&id_habilidad=${encodeURIComponent(idHabilidad)}`;
        break;
      case 'editar':
        window.location.href = `/Creatura_PHP/paginas/editar_habilidad.php?nombre_habilidad=${encodeURIComponent(nombreHabilidad)}&creador=<?= urlencode($_SESSION['nickname'])?>`;
        break;
      case 'eliminar':
        if (confirm(`¿Estás seguro de eliminar el tipo "${nombreHabilidad}"?`)) {
          window.location.href = `/Creatura_PHP/procesamiento/manejar_bajaHabilidad.php?id_habilidad=${encodeURIComponent(idHabilidad)}`;
        }
        break;
      default:
        break;
    }
  }
</script>
</body>
</html>
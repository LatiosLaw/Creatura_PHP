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
    <link rel="stylesheet" href="\Creatura_PHP\styles\gestor_habilidad.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>
    <?php include_once("../piezas_html/popup_adaptativo.php"); ?>
    <div class="cont-titular">
      <div class="titular">
        <div>Tus Habilidades</div>
        <div class="btns-titular">
          <button onclick="window.location.href = '/Creatura_PHP/paginas/alta_habilidad.php';">Crear Habilidad</button>
          <button onclick="history.back();">Volver</button>
        </div>
      </div>
    </div>
    <div class="habilidades">
      <table>
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
                <td><a href="/Creatura_PHP/paginas/ver_habilidad.php?nombre_habilidad=<?= urlencode($habilidad['nombre_habilidad'])?>&creador=<?= urlencode($habilidad['creador'])?>&id_habilidad=<?= urlencode($habilidad['id_habilidad'])?>"><div><?= htmlspecialchars($habilidad['nombre_habilidad']) ?></div></a></td>
                <td style="background-color: #<?= $tipo['color'] ?>;">
                  <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo['nombre_tipo']) ?>&creador=<?= urlencode($tipo['creador']) ?>&id_tipo=<?= urlencode($tipo['id_tipo']) ?>'>
                    <div><img src="/Creatura_PHP/imagenes/tipos/<?= urlencode($tipo['icono']) ?>"><?= htmlspecialchars($tipo['nombre_tipo']) ?></div>
                  </a>
                </td>
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
                    <option value="">. . .</option>
                    <option value="editar">Editar</option>
                    <option value="ver">Ver</option>
                    <option value="eliminar">Eliminar</option>
                  </select>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
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
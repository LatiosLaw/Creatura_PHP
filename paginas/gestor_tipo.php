<?php
include_once("../piezas_html/cabecera.php");

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$tipos_del_usuario = $controladorTipo->listar_tipos_creador($_SESSION['nickname']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tipos</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\gestor_tipo.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>
<?php include_once("../piezas_html/popup_adaptativo.php"); ?>

<div class="cont-titular">
  <div class="titular">
    <div>Tus Tipos</div>
    <button onclick="window.location.href = '/Creatura_PHP/paginas/alta_tipo.php';">Crear Tipo</button>
    <button onclick="history.back();">Volver</button>
  </div>
</div>
<div class="defensas">
  <?php foreach ($tipos_del_usuario as $tipo): ?>
    <div class="tipo" style="background-color: #<?= $tipo['color'] ?>;" href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo['nombre_tipo']) ?>&creador=<?= urlencode($_SESSION['nickname'])?>&id_tipo=<?= urlencode($tipo['id_tipo'])?>">
      <?php if (!empty($tipo['icono'])): ?>
        <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($tipo['icono']) ?>" alt="<?= htmlspecialchars($tipo['nombre_tipo']) ?>" width="32" style="vertical-align: middle;" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
      <?php endif; ?>
      <?= htmlspecialchars($tipo['nombre_tipo']) ?>
      <select onchange="manejarAccion(this.value, '<?= htmlspecialchars($tipo['nombre_tipo']) ?>', '<?= htmlspecialchars($tipo['id_tipo']) ?>')">
        <option value="">. . .</option>
        <option value="editar">Editar</option>
        <option value="ver">Ver</option>
        <option value="eliminar">Eliminar</option>
      </select>
    </div>
  <?php endforeach; ?>
</div>

     <?php include_once("../piezas_html/pie_pagina.php"); ?>
                    
     <script>
  function manejarAccion(accion, nombreTipo, id_Tipo) {
    if (!accion) return;

    switch (accion) {
      case 'ver':
        window.location.href = `/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=${encodeURIComponent(nombreTipo)}&creador=<?= urlencode($_SESSION['nickname'])?>&id_tipo=${encodeURIComponent(id_Tipo)}`;
        break;
      case 'editar':
        window.location.href = `/Creatura_PHP/paginas/editar_tipo.php?nombre_tipo=${encodeURIComponent(nombreTipo)}&creador=<?= urlencode($_SESSION['nickname'])?>&id_tipo=${encodeURIComponent(id_Tipo)}`;
        break;
      case 'eliminar':
        if (confirm(`¿Estás seguro de eliminar el tipo "${nombreTipo}"?`)) {
          window.location.href = `/Creatura_PHP/procesamiento/manejar_bajaTipo.php?id_tipo=${encodeURIComponent(id_Tipo)}`;
        }
        break;
      default:
        break;
    }
  }
</script>

                
</body>
</html>
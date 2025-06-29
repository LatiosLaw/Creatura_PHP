<?php
include_once("../piezas_html/cabecera.php");

if (isset($_SESSION['nickname'])) {
    $nickname_sesion = $_SESSION['nickname'];
}

require_once("../clases/tipo.php");
$controladorTipo = new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura = new Creatura();

$creaturas_usuario = $controladorCreatura->listar_creaturas_ext(1000, $nickname_sesion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Creaturas</title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\gestor_creatura.css">
    <link rel="shortcut icon" href="\Creatura_PHP\imagenes\Creatura_logo.png" type="image/x-icon">
</head>
<body>
<?php include_once("../piezas_html/popup_adaptativo.php"); ?>

    <div class="cont-titular">
        <div class="titular">
            <div>Tus Creaturas</div>
            <div class="btns-titular">
                <button onclick="window.location.href = '/Creatura_PHP/paginas/alta_creatura.php';">Crear Creatura</button>
                <button onclick="history.back();">Volver</button>
            </div>
        </div>
    </div>
    <div class="contenedor-creaturas">
        <?php while ($fila = mysqli_fetch_assoc($creaturas_usuario) ) :
            $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
            $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])
        ?>
        <div class="contenido-creatura">
            <div class="imagen-creatura">
                <img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            </div>
            <div class="nombre-creatura">
                <?= htmlspecialchars($fila['nombre_creatura']) ?>
            </div>
            <div class="acciones">
                <select onchange="manejarAccion(this.value, '<?= htmlspecialchars($fila['nombre_creatura']) ?>', '<?= htmlspecialchars($fila['id_creatura']) ?>')">
                    <option value="">. . .</option>
                    <option value="editar">Editar</option>
                    <option value="ver">Ver</option>
                    <option value="eliminar">Eliminar</option>
                </select>
            </div>
            <div class="tipos">
                <?php if ($fila['id_tipo1'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador'])?>&id_tipo=<?= urlencode($tipo1['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>"
                        <?php if($tipo1['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo1['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo1['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
                <?php if ($fila['id_tipo2'] != 0): ?>
                    <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador'])?>&id_tipo=<?= urlencode($tipo2['id_tipo'])?>">
                        <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" 
                        <?php if($tipo2['icono'] == "sin_icono.png"): ?>
                            style="background-color: #<?= $tipo2['color']; ?>
                        <?php endif; ?>
                        ;" alt="<?= $tipo2['nombre_tipo']; ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                    </a>
                <?php endif; ?>
            </div>
            <div class="rating">
                <?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5 de puntuación
            </div>
            <div class="creador-creatura">
                <?= htmlspecialchars($fila['creador']) ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

<?php include_once("../piezas_html/pie_pagina.php"); ?>

 <script>
  function manejarAccion(accion, nombreCreatura, idCreatura) {
    if (!accion) return;

    switch (accion) {
      case 'ver':
        window.location.href = `/Creatura_PHP/paginas/ver_creatura.php?creatura=${encodeURIComponent(nombreCreatura)}&creador=<?= urlencode($_SESSION['nickname'])?>`;
        break;
      case 'editar':
        window.location.href = `/Creatura_PHP/paginas/editar_creatura.php?nombre_creatura=${encodeURIComponent(nombreCreatura)}&creador=<?= urlencode($_SESSION['nickname'])?>&id_creatura=${encodeURIComponent(idCreatura)}`;
        break;
      case 'eliminar':
        if (confirm(`¿Estás seguro de eliminar el tipo "${nombreCreatura}"?`)) {
          window.location.href = `/Creatura_PHP/procesamiento/manejar_bajaCreatura.php?id_creatura=${encodeURIComponent(idCreatura)}`;
        }
        break;
      default:
        break;
    }
  }
</script>

</body>
</html>
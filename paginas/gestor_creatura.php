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
</head>
<body>

    <div>
        <h2>Tus Creaturas</h2>
        <button onclick="window.location.href = '/Creatura_PHP/paginas/alta_creatura.php';">Crear Creatura</button>
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo 1</th>
                    <th>Tipo 2</th>
                    <th>Rating</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($creaturas_usuario) ) :

                    $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
                    $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'])

                ?>
                    <tr>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><?= htmlspecialchars($fila['nombre_creatura']) ?></a></td>
                        <td>
                            <?php if ($fila['id_tipo1'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo1['nombre_tipo']) ?>&creador=<?= urlencode($tipo1['creador']) ?>&id_tipo=<?= urlencode($tipo1['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo1['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo1['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo1['nombre_tipo']; ?>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($fila['id_tipo2'] != 0): ?>
                                <a href='/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($tipo2['nombre_tipo']) ?>&creador=<?= urlencode($tipo2['creador']) ?>&id_tipo=<?= urlencode($tipo2['id_tipo']) ?>'>
                                <div style="background-color: #<?= $tipo2['color']; ?>; color: #fff; padding: 5px; display: flex; align-items: center; gap: 5px;">
                                    <img src="/Creatura_PHP/imagenes/tipos/<?= $tipo2['icono']; ?>" alt="" width="20" height="20" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                                    <?= $tipo2['nombre_tipo']; ?>
                                </div>
                                 </a>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($controladorCreatura->rating_promedio(($fila['id_creatura']))) ?>/5</td>
                        <td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($fila['nombre_creatura']) ?>&creador=<?= urlencode($fila['creador']) ?>"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($fila['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                        <td>
                            <select onchange="manejarAccion(this.value, '<?= htmlspecialchars($fila['nombre_creatura']) ?>', '<?= htmlspecialchars($fila['id_creatura']) ?>')">
    <option value="">-- Acciones --</option>
    <option value="ver">Ver</option>
    <option value="editar">Editar</option>
    <option value="eliminar">Eliminar</option>
  </select>
</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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
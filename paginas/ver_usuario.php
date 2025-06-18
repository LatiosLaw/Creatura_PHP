<?php
include_once("../piezas_html/cabecera.php");

require_once("../clases/usuario.php");
$controladorUsuario = new Usuario();

require_once("../clases/tipo.php");
$controladorTipo= new Tipo();

require_once("../clases/creatura.php");
$controladorCreatura= new Creatura();

if (isset($_GET['usuario'])) {
    $nickname_usuario = urldecode($_GET['usuario']);
}

if (isset($_SESSION['nickname'])) {
    $nickname_sesion = $_SESSION['nickname'];
}else{
    $nickname_sesion = "";
}

$informacion = $controladorUsuario->retornar_informacion_usuario($nickname_usuario);


$creaturas_usuario = $controladorUsuario->listar_creaturas_de_usuario($nickname_usuario, $controladorTipo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Perfil - <?php echo $nickname_usuario ?></title>
    <link rel="stylesheet" href="\Creatura_PHP\styles\ver_usuario.css">
</head>
<body>

<div class="cont-titular"> 
    <div class="titular">
        <div>Información del Usuario</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>

<div class="contenido-usuario">
    <img src="../imagenes/usuarios/<?= htmlspecialchars($informacion['foto']) ?>" alt="Imagen del Usuario" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
    <div class="info-personal">
        <h2><?= htmlspecialchars($informacion['nickname']) ?></h2>
        <p><strong>Correo:</strong> <?= htmlspecialchars($informacion['correo']) ?></p>
        <p><strong>Biografia:</strong> <?= htmlspecialchars($informacion['biografia']) ?></p>
        <?php if(strcmp($nickname_sesion, $nickname_usuario)==0){ ?>
            <button onclick="confirmarEliminacion()">Elimina la Cuenta 😈</button>
        <?php } ?>
    </div>
</div>

<div class="cont-titular"> 
    <div class="titular">
        <div>Creaturas del Usuario</div>
    </div>
</div>

<div class="contenedor-creaturas">
    <?php foreach ($creaturas_usuario as $creatura): ?>
    <div class="contenido-creatura" onclick="window.location.href='/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>'">
        <div class="imagen-creatura">
            <img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($creatura['imagen']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
        </div>
        <div class="nombre-creatura">
            <?= htmlspecialchars($creatura['nombre']) ?>
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
    <?php endforeach; ?>
</div>

    <div>
            <tbody>
                
                    <tr>
                        <td style="text-align:center;"><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>"></a></td>
<td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($creatura['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                        <td style="text-align:center;"><?= htmlspecialchars($controladorCreatura->rating_promedio(($creatura['id_creatura']))) ?>/5</td>

                        
                        <!-- Tipo 1 -->
                        <td style="background-color: #<?= $creatura['tipo1']['color'] ?>; color: #fff; text-align: center;">
                            <?php if (!empty($creatura['tipo1']['icono'])): ?>
                                <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($creatura['tipo1']['icono']) ?>" alt="<?= htmlspecialchars($creatura['tipo1']['nombre_tipo']) ?>" width="32" style="vertical-align: middle;" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                            <?php endif; ?>
                            <?= htmlspecialchars($creatura['tipo1']['nombre_tipo']) ?>
                        </td>

                        <!-- Tipo 2 -->
                        <td style="background-color: #<?= $creatura['tipo2']['color'] ?>; color: #fff; text-align: center;">
                            <?php if (!empty($creatura['tipo2']['icono'])): ?>
                                <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($creatura['tipo2']['icono']) ?>" alt="<?= htmlspecialchars($creatura['tipo2']['nombre_tipo']) ?>" width="32" style="vertical-align: middle;" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                            <?php endif; ?>
                            <?= htmlspecialchars($creatura['tipo2']['nombre_tipo']) ?>
                        </td>
                    
                    </tr>
                
            </tbody>
        </table>
    </div>
</div>

<div class="contenedor-creaturas">
    <?php foreach ($creaturas_usuario as $creatura): ?>
    <div class="contenido-creatura" onclick="window.location.href='/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>'">
        <div class="imagen-creatura">
            <img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($creatura['imagen']) ?>" alt="Imagen" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
        </div>
        <div class="nombre-creatura">
            <?= htmlspecialchars($creatura['nombre']) ?>
        </div>
        <div class="tipos">
            <?php if (!empty($creatura['tipo1']['icono'])): ?>
                <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($creatura['tipo1']['nombre_tipo']) ?>&creador=<?= urlencode($creatura['tipo1']['creador'])?>&id_tipo=<?= urlencode($creatura['tipo1']['id_tipo'])?>">
                    <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($creatura['tipo1']['icono']) ?>"
                    <?php if($creatura['tipo1']['icono'] == "sin_icono.png"): ?>
                        style="background-color: #<?= $creatura['tipo1']['color']; ?>
                    <?php endif; ?>
                    ;" alt="<?= htmlspecialchars($creatura['tipo1']['nombre_tipo']) ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                </a>
            <?php endif; ?>
            <?php if (!empty($creatura['tipo2']['icono'])): ?>
                <a href="/Creatura_PHP/paginas/ver_tipo.php?nombre_tipo=<?= urlencode($creatura['tipo2']['nombre_tipo']) ?>&creador=<?= urlencode($creatura['tipo2']['creador'])?>&id_tipo=<?= urlencode($creatura['tipo2']['id_tipo'])?>">
                    <img src="/Creatura_PHP/imagenes/tipos/<?= htmlspecialchars($creatura['tipo2']['icono']) ?>"
                    <?php if($creatura['tipo2']['icono'] == "sin_icono.png"): ?>
                        style="background-color: #<?= $creatura['tipo2']['color']; ?>
                    <?php endif; ?>
                    ;" alt="<?= htmlspecialchars($creatura['tipo2']['nombre_tipo']) ?>" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
                </a>
            <?php endif; ?>
        </div>
        <div class="rating">
            <?= htmlspecialchars($controladorCreatura->rating_promedio(($creatura['id_creatura']))) ?>/5 de puntuación
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include_once("../piezas_html/pie_pagina.php"); ?>
            
            <script>

                function confirmarEliminacion() {
      if (confirm('¿Estás seguro de que quieres eliminar tu perfil? Esta acción no se puede deshacer.')) {
        window.location.href = '/Creatura_PHP/procesamiento/manejar_bajaUsuario.php';
      }
    }
    
            </script>
</body>
</html>
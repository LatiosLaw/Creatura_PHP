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
</head>
<body>

<button onclick="window.location.href = document.referrer || '/Creatura_PHP/index.php';">Volver</button>

<div>
        <h1>Información de un Usuario</h1>
        <div style="display: flex; gap: 20px;">
            <img src="../imagenes/usuarios/<?= htmlspecialchars($informacion['foto']) ?>" alt="Imagen del Usuario" width="200" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
            <div>
                <h2><?= htmlspecialchars($informacion['nickname']) ?></h2>
                <p><strong>Correo:</strong> <?= htmlspecialchars($informacion['correo']) ?></p>
                <p><strong>Biografia:</strong> <?= htmlspecialchars($informacion['biografia']) ?></p>
            </div>
        </div>
        <?php if(strcmp($nickname_sesion, $nickname_usuario)==0){ ?>
<button onclick="window.location.href='/Creatura_PHP/procesamiento/manejar_bajaUsuario.php'">Eliminar Perfil</button>
            <?php } ?>
    </div>

    <div>
        <h1>Creaturas del Usuario</h1>
        <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>Nombre de la Creatura</th>
                    <th>Imagen</th>
                    <th>Rating</th>
                    <th>Tipo 1</th>
                    <th>Tipo 2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($creaturas_usuario as $creatura): ?>
                    <tr>
                        <td style="text-align:center;"><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>"><?= htmlspecialchars($creatura['nombre']) ?></a></td>
<td><a href="/Creatura_PHP/paginas/ver_creatura.php?creatura=<?= urlencode($creatura['nombre']) ?>&creador=<?= urlencode($nickname_usuario) ?>"><img src="/Creatura_PHP/imagenes/creaturas/<?= htmlspecialchars($creatura['imagen']) ?>" alt="Imagen" width="50" height="50" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';"></a></td>
                        <td style="text-align:center;"><?= htmlspecialchars($controladorCreatura->rating_promedio(($creatura['id_creatura']))) ?>/5</td>

                        
                        <!-- Tipo 1 -->
                        <td style="background-color: #<?= $creatura['tipo1']['color'] ?>; color: #fff; text-align: center;">
                            <?php if (!empty($creatura['tipo1']['icono'])): ?>
                                <img src="../imagenes/tipos/<?= htmlspecialchars($creatura['tipo1']['icono']) ?>" alt="<?= htmlspecialchars($creatura['tipo1']['nombre_tipo']) ?>" width="32" style="vertical-align: middle;">
                            <?php endif; ?>
                            <?= htmlspecialchars($creatura['tipo1']['nombre_tipo']) ?>
                        </td>

                        <!-- Tipo 2 -->
                        <td style="background-color: #<?= $creatura['tipo2']['color'] ?>; color: #fff; text-align: center;">
                            <?php if (!empty($creatura['tipo2']['icono'])): ?>
                                <img src="../imagenes/tipos/<?= htmlspecialchars($creatura['tipo2']['icono']) ?>" alt="<?= htmlspecialchars($creatura['tipo2']['nombre_tipo']) ?>" width="32" style="vertical-align: middle;">
                            <?php endif; ?>
                            <?= htmlspecialchars($creatura['tipo2']['nombre_tipo']) ?>
                        </td>
                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
            <?php include_once("../piezas_html/pie_pagina.php"); ?>
</body>
</html>
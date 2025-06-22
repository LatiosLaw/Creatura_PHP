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
    <link rel="stylesheet" href="\Creatura_PHP\styles\modificar_perfil.css">
</head>
<body>

<div class="cont-titular"> 
    <div class="titular">
        <div>Información del Usuario</div>
        <button onclick="history.back();">Volver</button>
    </div>
</div>

<form id="formAltaCreatura" action="../procesamiento/manejar_modificacionPerfil.php" method="POST" enctype="multipart/form-data">
<div class="contenido-usuario">
    <div class="imagen">
        <p>Nueva Foto de Perfil :</p>
        <input name="foto" type="file" accept="image/png, image/jpeg">
        <img src="../imagenes/usuarios/<?= htmlspecialchars($informacion['foto']) ?>" alt="Imagen del Usuario" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
    </div>

    <div class="info-personal">
        <input type="text" name="nick_viejo" value="<?= htmlspecialchars($informacion['nickname']) ?>" hidden>
        <input type="text" name="correo_viejo" value="<?= htmlspecialchars($informacion['correo']) ?>" hidden>

        <p>Nickname : <input type="text" name="nickname" value="<?= htmlspecialchars($informacion['nickname']) ?>"></p>
        <p>Correo : <input type="email" name="correo" value="<?= htmlspecialchars($informacion['correo']) ?>"></p>
        <p>Biografia : <input type="text" name="biografia" value="<?= htmlspecialchars($informacion['biografia']) ?>"></p>
        <button type="submit">Guardar Cambios</button>
    </div>
</div>
</form>

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
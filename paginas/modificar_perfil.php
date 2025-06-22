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

<form id="formAltaCreatura" action="../procesamiento/manejar_modificacionPerfil.php" method="POST" enctype="multipart/form-data" onsubmit="return verificarContrasenas()">
  <div class="contenido-usuario">
    <div class="imagen">
      <p>Nueva Foto de Perfil:</p>
      <input name="foto" type="file" accept="image/png, image/jpeg" id="fotoInput">
      <img id="userImage" src="../imagenes/usuarios/<?= htmlspecialchars($informacion['foto']) ?>" alt="Imagen del Usuario" onerror="this.onerror=null; this.src='/Creatura_PHP/imagenes/sin_imagen.png';">
    </div>

    <div class="info-personal">
      <p>Nickname</p>
      <input type="text" name="nickname" maxlength="30" value="<?= htmlspecialchars($informacion['nickname']) ?>" readonly style="background-color: #e9ecef; color: #6c757d;">
      
      <p>Correo</p>
      <input type="email" name="correo" maxlength="30" value="<?= htmlspecialchars($informacion['correo']) ?>" readonly style="background-color: #e9ecef; color: #6c757d;">
      
      <p>Biografia</p>
      <input type="text" name="biografia" maxlength="200" value="<?= htmlspecialchars($informacion['biografia']) ?>">
      
      <p>Nueva Contraseña (Opcional)</p>
      <input id="contra" type="password" name="contra" placeholder="Contraseña" maxlength="30">
      
      <p>Verificar Nueva Contraseña</p>
      <input id="ver_contra" name="ver_contra" type="password" placeholder="Verificar Contraseña" maxlength="30">

      <button type="submit">Guardar Cambios</button>
    </div>
  </div>
</form>

<?php include_once("../piezas_html/pie_pagina.php"); ?>
            
            <script>
                document.getElementById('fotoInput').addEventListener('change', function(event) {
                    const file = event.target.files[0];

                    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            document.getElementById('userImage').src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                    }
                });

                 function verificarContrasenas() {
    const contra = document.getElementById('contra').value;
    const verContra = document.getElementById('ver_contra').value;

    if (contra === '' && verContra === '') {
      return true; // No se ingresó nada, se permite enviar
    }

    if (contra.length < 8 || verContra.length < 8) {
      alert('La contraseña debe tener al menos 8 caracteres.');
      return false;
    }

    if (contra !== verContra) {
      alert('Las contraseñas no coinciden.');
      return false;
    }

    return true;
  }
            </script>
</body>
</html>
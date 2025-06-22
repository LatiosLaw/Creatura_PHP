<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\Creatura_PHP\styles\cabecera.css">
</head>
<body>
  <header class="cabecera-bar">
    <button onclick="location.href='/Creatura_PHP/index.php'">Inicio</button>

    <div class="botones-usuario btn-usr-medio">
    <?php if (isset($_SESSION['nickname'])) { ?>
        <button onclick="location.href='/Creatura_PHP/paginas/gestor_creatura.php'">Tus Creaturas</button>
        <button onclick="location.href='/Creatura_PHP/paginas/gestor_tipo.php'">Tus Tipos</button>
        <button onclick="location.href='/Creatura_PHP/paginas/gestor_habilidad.php'">Tus Habilidades</button>
      <?php } ?>
      </div>

    <form action="/Creatura_PHP/procesamiento/buscar.php" method="post">
      <input type="text" name="campo_busqueda" placeholder="...">
      <input type="submit" value="Buscar">
    </form>

    <div class="botones-usuario btn-usr-derecha">
      <?php 
      if (isset($_SESSION['nickname'])) { ?>
      <button onclick="location.href='/Creatura_PHP/paginas/ver_usuario.php?usuario=<?php echo $_SESSION['nickname']?>'">Mi Perfil</button>
        <button onclick="location.href='/Creatura_PHP/procesamiento/manejar_logout.php'">Logout</button>
      <?php } else { ?>
        <button onclick="abrirModal('loginModal')">Iniciar Sesión</button>
        <button onclick="abrirModal('registroModal')">Registrarse</button>
      <?php } ?>
    </div>
  </header>

<!-- Modal Iniciar Sesión -->
<div id="loginModal" class="modal-overlay">
  <div class="modal-inicio-sesion">
    <span class="close-btn" onclick="cerrarModal('loginModal')">&times;</span>
    <h2>Iniciar Sesión</h2>
    <form action="/Creatura_PHP/procesamiento/manejar_login.php" method="POST">
      <input type="text" name="nickname" placeholder="Nickname" required>
      <input type="password" name="contra" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>
  </div>
</div>

<!-- Modal Registro -->
<div id="registroModal" class="modal-overlay">
  <div class="modal-registro-usuario">
    <span class="close-btn" onclick="cerrarModal('registroModal')">&times;</span>
    <h2>Registrarse</h2>
    <form  id="formRegistro_USUARIO" method="POST" enctype="multipart/form-data">
      <input type="text" name="nickname" placeholder="Nickname" maxlength="30" required>
      <input type="password" name="contra" placeholder="Contraseña" maxlength="30" required>
      <input name="ver_contra" type="password" placeholder="Verificar Contraseña" maxlength="30" required>
      <input type="email" name="correo" placeholder="Email" maxlength="35" required>
       Foto de Perfil (opcional) <input name="foto" type="file" accept="image/png, image/jpeg">
      <input name="biografia" type="text" placeholder="Biografía (opcional, máximo 200 caracteres)" maxlength="200">
      <button type="submit">Registrar</button>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById('formRegistro_USUARIO');

  form.addEventListener('submit', function (e) {
    const password = form.querySelector('input[name="contra"]').value;
    const confirmPassword = form.querySelector('input[name="ver_contra"]').value;

    if (password.length < 8) {
      alert('La contraseña debe tener al menos 8 caracteres.');
      e.preventDefault();
      return;
    }

    if (password !== confirmPassword) {
      alert('Las contraseñas no coinciden.');
      e.preventDefault();
      return;
    }

    // Asigna la acción del formulario
    form.action = "/Creatura_PHP/procesamiento/manejar_altaUsuario.php";
  });
});

  function abrirModal(id) {
    document.getElementById(id).style.display = 'flex';
  }

  function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  // Cierra el modal si se hace clic fuera del contenido
  document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('mousedown', function(e) {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <style>
    .cabecera-bar{
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: darkgray;
      color: white;
      margin-bottom: 20px;
    }

    .cabecera-bar button {
      background-color: black;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .cabecera-bar button:hover {
      background-color: gray;
    }

    .cabecera-bar form {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .cabecera-bar input[type="text"] {
      padding: 8px 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 350px;
      transition: border-color 0.3s ease;
    }

    .cabecera-bar input[type="text"]:focus {
      border-color: lightskyblue;
      outline: none;
    }

    .cabecera-bar input[type="submit"] {
      padding: 8px 15px;
      background-color: black;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .cabecera-bar input[type="submit"]:hover {
        background-color: gray;
    }

    .botones-usuario {
      display: flex;
      gap: 15px;
    }

    .modal-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .modal-registro-usuario, .modal-inicio-sesion{
      background: white;
      padding: 20px;
      border-radius: 8px;
      width: 300px;
      max-width: 90%;
    }

    .modal-registro-usuario h2, .modal-inicio-sesion h2{
      margin-top: 0;
    }

    .modal-registro-usuario form, .modal-inicio-sesion form{
      display: flex;
      flex-direction: column;
    }

    .modal-registro-usuario form input, .modal-inicio-sesion form input{
      margin-bottom: 10px;
      padding: 8px;
      font-size: 14px;
    }

    .modal-registro-usuario form button, .modal-inicio-sesion form button{
      padding: 10px;
      background-color: #333;
      color: white;
      border: none;
      cursor: pointer;
    }

    .close-btn {
      float: right;
      cursor: pointer;
      font-weight: bold;
      font-size: 16px;
      background-color: red;
      padding: 5px 15px;
      color: white;
    }
  </style>
</head>
<body>
  <header class="cabecera-bar">
    <button onclick="location.href='/Creatura_PHP/index.php'">Inicio</button>

    <form action="/Creatura_PHP/procesamiento/buscar.php" method="post">
      <input type="text" name="campo_busqueda" placeholder="Placeholder">
      <input type="submit" value="Buscar">
    </form>

    <div class="botones-usuario">
      <?php session_start();
      if (isset($_SESSION['nickname'])) { ?>
        <button onclick="location.href='/Creatura_PHP/procesamiento/manejar_logout.php'">Logout (<?= $_SESSION['nickname'] ?>)</button>
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
    <form action="/Creatura_PHP/procesamiento/manejar_altaUsuario.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="nickname" placeholder="Nickname" required>
      <input type="password" name="contra" placeholder="Contraseña" required>
      <input name="ver_contra" type="password" placeholder="Verificar Contraseña" required>
      <input type="email" name="correo" placeholder="Email" required>
       Foto de Perfil <input name="foto" type="file" accept="image/png, image/jpeg">
    Biografia <input name="biografia" type="text">
      <button type="submit">Registrar</button>
    </form>
  </div>
</div>

<script>
  function abrirModal(id) {
    document.getElementById(id).style.display = 'flex';
  }

  function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  // Cierra el modal si se hace clic fuera del contenido
  document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>
</body>
</html>
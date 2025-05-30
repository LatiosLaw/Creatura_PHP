<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJEMPLO ALTA USUARIO</title>
</head>
<body>
    <a href="../index.php"><button>Regresar</button></a>
    
    <div>
        <form action="../procesamiento/manejar_altaUsuario.php" method="POST" enctype="multipart/form-data">
            Nickname <input name="nickname" type="text"><br>
            Correo <input name="correo" type="email"><br>
            Contraseña <input name="contra" type="password"><br>
            Verificar Contraseña <input name="ver_contra" type="password"><br>
            Foto de Perfil <input name="foto" type="file" accept="image/png, image/jpeg"><br>
            Biografia <input name="biografia" type="text"><br><br>
            <input type="submit">
        </form>
    </div>
</body>
</html>
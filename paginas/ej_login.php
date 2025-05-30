<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJEMPLO LOGIN</title>
</head>
<body>
    
<a href="../index.php"><button>Regresar</button></a>

<?php
session_start(); // ¡Muy importante! Siempre al inicio

if (isset($_SESSION['nickname'])) {
    echo "<p>Nickname: " . htmlspecialchars($_SESSION['nickname']) . "</p>";
} else {
    echo "<p>No has iniciado sesión.</p>";
}
?>

<p><form action="../procesamiento/manejar_login.php" method="POST">
Nickname<input name="nickname" type="text"><br>
Contraseña<input name="contra" type="password"><br>
<input type="submit">
</form></p>

</body>
</html>
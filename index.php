<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de Verdad</title>
</head>
<body>

    <?php
session_start(); 

if (isset($_SESSION['nickname'])) {
    echo "<p>Nickname: " . htmlspecialchars($_SESSION['nickname']) . "</p>";
} else {
    echo "<p>No has iniciado sesión.</p>";
}
?>
    <a href="./paginas/testin.php"><button>Zona de Testeo</button></a>
    <a href="./paginas/testin2.php"><button>Zona de Busqueda</button></a>
    <a href="./paginas/ej_alta_usuario.php"><button>EJ Alta Usuario</button></a>
    <a href="./paginas/ej_login.php"><button>EJ Login</button></a>
    <a href="./procesamiento/manejar_logout.php"><button>EJ Logout</button></a>
    <a href="./paginas/ej_alta_habilidad.php"><button>EJ Alta Habilidad</button></a>
    <a href="./paginas/ej_alta_tipo.php"><button>EJ Alta Tipo</button></a>
    <a href="./paginas/ej_alta_creatura.php"><button>EJ Alta Creatura</button></a>
</body>
</html>
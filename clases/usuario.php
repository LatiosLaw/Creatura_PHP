<?php

require_once(__DIR__ . "/conexion.php");

class Usuario {

    private $conexionHandler;
    private $conexion;

    public function __construct()
    {
        $this->conexionHandler = new Conexion();
        // Usa el archivo de conexión para inicializar la propiedad
        $this->conexion = $this->conexionHandler->conectar(); // Asegurate que `conectar()` devuelve la conexión
    }

// Para manejar las consultas a la BD relacionadas con Usuarios

function alta_usuario($nickname, $correo, $foto, $biografia, $contraseña, $tipo) {
    // Verificar si ya existe el nickname o el correo
    $check_query = "SELECT * FROM usuario WHERE nickname = ? OR correo = ?";
    $stmt = mysqli_prepare($this->conexion, $check_query);
    mysqli_stmt_bind_param($stmt, "ss", $nickname, $correo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Ya existe un usuario con ese nickname o correo
        return 0;
    }

    // Insertar nuevo usuario
    $insert_query = "INSERT INTO usuario (nickname, correo, foto, biografia, contraseña, tipo) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($this->conexion, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssssss", $nickname, $correo, $foto, $biografia, $contraseña, $tipo);

    return mysqli_stmt_execute($stmt) ? 1 : 0;
}

function baja_usuario($nickname) {
    $query = "DELETE FROM usuario WHERE nickname = '$nickname'";
    return mysqli_query($this->conexion, $query);
}

function modificar_usuario($nickname, $correo, $foto, $biografia, $contraseña, $tipo) {
    $query = "UPDATE usuario SET
        correo = '$correo',
        foto = '$foto',
        biografia = '$biografia',
        contraseña = '$contraseña',
        tipo = '$tipo'
    WHERE nickname = '$nickname'";

    return mysqli_query($this->conexion, $query);
}

  function listar_usuarios() {
    $resultado = mysqli_query($this->conexion, "SELECT nickname, foto, biografia from usuario");
    return $resultado;
  }

  function retornar_usuario_personal($nickname){
    $resultado = mysqli_query($this->conexion, "SELECT * from usuario WHERE nickname = '$nickname'");
    return mysqli_fetch_assoc($resultado);
  }

  function listar_creaturas_de_usuario($nickname, $controladorTipo) {
        
    // Consulta todas las criaturas del creador
    $query = "SELECT * FROM creatura WHERE creador = ?";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $nickname);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $creaturas = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Obtener datos del tipo1
        $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
        $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2']);

        $creaturas[] = [
            'id_creatura' => $fila['id_creatura'],
            'nombre' => $fila['nombre_creatura'],
            'tipo1' => $tipo1,
            'tipo2' => $tipo2
        ];
    }

    return $creaturas;
}
}
?>
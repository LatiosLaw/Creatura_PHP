<?php

include_once("./clases/tipo.php");

class Usuario {

// Para manejar las consultas a la BD relacionadas con Usuarios

function alta_usuario($nickname, $correo, $foto, $biografia, $contraseña, $tipo, $conexion) {
    $query = "INSERT INTO usuario (
        nickname, correo, foto, biografia, contraseña, tipo
    ) VALUES (
        '$nickname', '$correo', '$foto', '$biografia', '$contraseña', '$tipo'
    )";

    return mysqli_query($conexion, $query);
}

function baja_usuario($nickname, $conexion) {
    $query = "DELETE FROM usuario WHERE nickname = '$nickname'";
    return mysqli_query($conexion, $query);
}

function modificar_usuario($nickname, $correo, $foto, $biografia, $contraseña, $tipo, $conexion) {
    $query = "UPDATE usuario SET
        correo = '$correo',
        foto = '$foto',
        biografia = '$biografia',
        contraseña = '$contraseña',
        tipo = '$tipo'
    WHERE nickname = '$nickname'";

    return mysqli_query($conexion, $query);
}

  function listar_usuarios($conexion) {
    $resultado = mysqli_query($conexion, "SELECT nickname, foto, biografia from usuario");
    return $resultado;
  }

  function retornar_usuario_personal($nickname, $conexion){
    $resultado = mysqli_query($conexion, "SELECT * from usuario WHERE nickname = '$nickname'");
    return mysqli_fetch_assoc($resultado);
  }

  function listar_creaturas_de_usuario($nickname, $conexion) {
        
    $controladorTipo = new Tipo();
        
    // Consulta todas las criaturas del creador
    $query = "SELECT * FROM creatura WHERE creador = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $nickname);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $creaturas = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Obtener datos del tipo1
        $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1'], $conexion);
        $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2'], $conexion);

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
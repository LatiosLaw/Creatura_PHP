<?php
class Usuario {

// Para manejar las consultas a la BD relacionadas con Usuarios

  function listar_usuarios($conexion) {
    $resultado = mysqli_query($conexion, "SELECT nickname, foto, biografia from usuario");
    return $resultado;
  }
}
?>
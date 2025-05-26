<?php

class Conexion {

  private $ip = "localhost";
  private $usuario = "tecnologo";
  private $contra = "tecnologo";
  private $bd = "cure";

  // Funcion para conectar
  function conectar() {
  $conexion = mysqli_connect($this->ip, $this->usuario, $this->contra, $this->bd);

  if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
  }

  return $conexion;
  }

  function desconectar($conexion) {
    mysqli_close($conexion);
  }

}

?>
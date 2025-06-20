<?php

require_once(__DIR__ . "/conexion.php");

class Tipo {

    private $conexionHandler;
    private $conexion;

    public function __construct()
    {
        $this->conexionHandler = new Conexion();
        // Usa el archivo de conexión para inicializar la propiedad
        $this->conexion = $this->conexionHandler->conectar(); // Asegurate que `conectar()` devuelve la conexión
    }

// Para manejar las consultas a la BD relacionadas con Tipos

function alta_tipo($nombre_tipo, $color, $icono, $creador) {
    $query = "INSERT INTO tipo (nombre_tipo, color, icono, creador) VALUES ('$nombre_tipo', '$color', '$icono', '$creador')";
    
    if (mysqli_query($this->conexion, $query)) {
        return 1;
    } else {
        return 0;
    }
}

function baja_tipo($id_tipo) {
    $query = "DELETE FROM tipo WHERE id_tipo = $id_tipo";
    return mysqli_query($this->conexion, $query);
}

function modificar_tipo($nombre_original, $nombre_tipo, $color, $icono, $creador) {
    $query = "UPDATE tipo SET
        nombre_tipo = '$nombre_tipo',
        color = '$color',
        icono = '$icono',
        creador = '$creador'
    WHERE nombre_tipo = '$nombre_original' AND creador = '$creador'";

    if (mysqli_query($this->conexion, $query)) {
        return 1;
    } else { 
        return 0;
    }
}


  function retornar_tipo($id_tipo) {

    if ($id_tipo == 0) {
        return [
            "id_tipo" => 0,
            "nombre_tipo" => "-",
            "color" => "AAAAAA",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM"
        ];
    }

    $query = "SELECT * FROM tipo WHERE id_tipo = $id_tipo";
    $resultado = mysqli_query($this->conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        // En caso de que no se encuentre el tipo (inexistente)
        return [
            "id_tipo" => 0,
            "nombre_tipo" => "-",
            "color" => "AAAAAA",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM_ERROR"
        ];
    }
  }

  function retornar_tipo_API($id_tipo) {

    if ($id_tipo == 0) {
        return [
            "id_tipo" => 0,
            "nombre_tipo" => "-",
            "color" => "aaaaaa",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM"
        ];
    }

    $query = "SELECT * FROM tipo WHERE id_tipo = $id_tipo";
    $resultado = mysqli_query($this->conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        // En caso de que no se encuentre el tipo (inexistente)
        return [
            "id_tipo" => 0,
            "nombre_tipo" => "-",
            "color" => "aaaaaa",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM_ERROR"
        ];
    }
  }

  function retornar_tipo_por_creador($nombre, $creador) {

    $query = "SELECT * FROM tipo WHERE creador = '$creador' AND nombre_tipo = '$nombre'";
    $resultado = mysqli_query($this->conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        // En caso de que no se encuentre el tipo (inexistente)
        return [
            "id_tipo" => "0",
            "nombre_tipo" => "-",
            "color" => "aaaaaa",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM_ERROR"
        ];
    }
  }

  function retornar_creaturas_tipo($id_tipo){
$resultado = mysqli_query($this->conexion, "SELECT * from creatura WHERE id_tipo1 = $id_tipo OR id_tipo2 = $id_tipo AND publico = 1");
    return $resultado;
  }

  function retornar_habilidades_tipo($id_tipo){
    $resultado = mysqli_query($this->conexion, "SELECT * from habilidad WHERE id_tipo_habilidad = $id_tipo");
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }
  function retornar_habilidades_api(){
	$controladorTipo = new Tipo();
    $resultado = mysqli_query($this->conexion, "
			SELECT 
            h.*, 
            t.nombre_tipo AS nombre_tipo_habilidad,
            t.color AS color_tipo_habilidad,
            t.icono AS icono_tipo_habilidad
        FROM habilidad h
        INNER JOIN tipo t ON h.id_tipo_habilidad = t.id_tipo
    ");
	
	
	//$tipo = $controladorTipo->retornar_tipo($resultado['id_tipo_habilidad']);
	
	
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	
  }

  function listar_tipos(){
    $resultado = mysqli_query($this->conexion, "SELECT * from tipo");
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  function listar_tipos_creador($creador){
    $resultado = mysqli_query($this->conexion, "SELECT * from tipo where creador = '$creador'");
    return $resultado;
  }

////////////////////////////////////////////////////////////////////////////////////
////////////////////// ABL DE EFECTIVIDAD //////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function alta_efectividad($atacante, $defensor, $multiplicador) {
        $query = "INSERT INTO efectividades (
            atacante, defensor, multiplicador
        ) VALUES (
            $atacante, $defensor, $multiplicador
        )";

        return mysqli_query($this->conexion, $query);
    }

    function baja_efectividad($id_efectividad) {
    $query = "DELETE FROM efectividades WHERE id_efectividad = $id_efectividad";
    return mysqli_query($this->conexion, $query);
}

function eliminar_efectividades($id_tipo) {
    $query = "DELETE FROM efectividades WHERE atacante = $id_tipo OR defensor = $id_tipo";
    return mysqli_query($this->conexion, $query);
}

function modificar_efectividad($atacante, $defensor, $multiplicador) {
    $query = "UPDATE efectividades SET
        multiplicador = $multiplicador
    WHERE atacante = $atacante AND defensor = $defensor";

    return mysqli_query($this->conexion, $query);
}

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

}

?>
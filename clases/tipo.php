<?php
class Tipo {

// Para manejar las consultas a la BD relacionadas con Tipos

function alta_tipo($nombre_tipo, $color, $icono, $creador, $conexion) {
    $query = "INSERT INTO tipo (
        nombre_tipo, color, icono, creador
    ) VALUES (
        '$nombre_tipo', '$color', '$icono', '$creador'
    )";

    return mysqli_query($conexion, $query);
}

function baja_tipo($id_tipo, $conexion) {
    $query = "DELETE FROM tipo WHERE id_tipo = $id_tipo";
    return mysqli_query($conexion, $query);
}

function modificar_tipo($nombre_tipo, $color, $icono, $creador, $conexion) {
    $query = "UPDATE tipo SET
        nombre_tipo = '$nombre_tipo',
        color = '$color',
        icono = '$icono',
        creador = '$creador'
    WHERE nombre_tipo = '$nombre_tipo' AND creador = '$creador'";

    return mysqli_query($conexion, $query);
}

  function retornar_tipo($id_tipo, $conexion) {

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
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    } else {
        // En caso de que no se encuentre el tipo (inexistente)
        return [
            "id_tipo" => $id_tipo,
            "nombre_tipo" => "-",
            "color" => "aaaaaa",
            "icono" => "sin_icono.png",
            "creador" => "SYSTEM_ERROR"
        ];
    }
  }

  function retornar_habilidades_tipo($id_tipo, $conexion){
    $resultado = mysqli_query($conexion, "SELECT * from habilidad WHERE id_tipo_habilidad = $id_tipo");
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  function listar_tipos($conexion){
    $resultado = mysqli_query($conexion, "SELECT * from tipo");
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

////////////////////////////////////////////////////////////////////////////////////
////////////////////// ABL DE EFECTIVIDAD //////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function alta_efectividad($atacante, $defensor, $multiplicador, $conexion) {
        $query = "INSERT INTO efectividades (
            id_efectividad, atacante, defensor, multiplicador
        ) VALUES (
            $atacante, $defensor, $multiplicador
        )";

        return mysqli_query($conexion, $query);
    }

    function baja_efectividad($id_efectividad, $conexion) {
    $query = "DELETE FROM efectividades WHERE id_efectividad = $id_efectividad";
    return mysqli_query($conexion, $query);
}

function modificar_efectividad($atacante, $defensor, $multiplicador, $conexion) {
    $query = "UPDATE efectividades SET
        multiplicador = $multiplicador
    WHERE atacante = $atacante AND defensor = $defensor";

    return mysqli_query($conexion, $query);
}

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

}

?>
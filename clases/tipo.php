<?php
class Tipo {

// Para manejar las consultas a la BD relacionadas con Tipos

  function retornar_tipo($conexion, $id_tipo) {

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

}

?>
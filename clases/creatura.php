<?php
class Creatura {

    // Para manejar las consultas a la BD relacionadas con Creaturas

  function listar_creaturas($conexion) {
    $resultado = mysqli_query($conexion, "SELECT * from creatura");
    return $resultado;
  }

  function listar_creaturas_ext($conexion, $cantidad, $creador) {

    if($creador!=null){
        $resultado = mysqli_query($conexion, "SELECT * from creatura WHERE creador = '$creador' LIMIT $cantidad");
        return $resultado;
    }else{
        $resultado = mysqli_query($conexion, "SELECT * from creatura LIMIT $cantidad");
        return $resultado;
    }
  }

function retornar_creatura($nombre_creatura, $creador, $conexion) {

    $query = "SELECT * FROM creatura WHERE nombre_creatura = '$nombre_creatura' AND creador = '$creador'";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado); 
    } else {
        return false;
    }
}


  function retornar_habilidades($id_creatura, $conexion) {
    $query = "SELECT h.* FROM moveset m INNER JOIN habilidad h ON m.id_habilidad = h.id_habilidad WHERE m.id_creatura = $id_creatura";
    $resultado = mysqli_query($conexion, $query);
    $habilidades = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $habilidades[] = $fila;
        }
    }
    return $habilidades;
    }

    function retornar_calculo_de_tipos_defendiendo($id_tipo1, $id_tipo2, $conexion) {
    
    // Primero obtenemos todos los tipos atacantes
    $tipos = [];
    $consulta_tipos = mysqli_query($conexion, "SELECT * FROM tipo");
    while ($tipo = mysqli_fetch_assoc($consulta_tipos)) {
        $tipos[$tipo['id_tipo']] = $tipo;
        $tipos[$tipo['id_tipo']]['multiplicador1'] = 1.0;
        $tipos[$tipo['id_tipo']]['multiplicador2'] = 1.0;
    }

    // Efectividades sobre el tipo1
    $ef1 = mysqli_query($conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo1");
    while ($fila = mysqli_fetch_assoc($ef1)) {
        $tipos[$fila['atacante']]['multiplicador1'] = $fila['multiplicador'];
    }

    // Efectividades sobre el tipo2
    $ef2 = mysqli_query($conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo2");
    while ($fila = mysqli_fetch_assoc($ef2)) {
        $tipos[$fila['atacante']]['multiplicador2'] = $fila['multiplicador'];
    }

    // Resultado final
    $resultado = [];

    foreach ($tipos as $id => $tipo) {
        // Multiplicador final
        $m1 = $tipo['multiplicador1'];
        $m2 = $tipo['multiplicador2'];

        // Inmunidad prevalece
        if ($m1 == 0 || $m2 == 0) {
            $total = 0;
        } else {
            $total = $m1 * $m2;
        }

        $resultado[] = [
            'id_tipo' => $id,
            'nombre_tipo' => $tipo['nombre_tipo'],
            'color' => $tipo['color'],
            'icono' => $tipo['icono'],
            'multiplicador' => $total
        ];
    }

    return $resultado;
}

}
?>
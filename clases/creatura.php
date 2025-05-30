<?php

class Creatura
{

    // Para manejar las consultas a la BD relacionadas con Creaturas

    function listar_creaturas($conexion)
    {
        $resultado = mysqli_query($conexion, "SELECT * from creatura");
        return $resultado;
    }

    function listar_creaturas_ext($conexion, $cantidad, $creador)
    {

        if ($creador != null) {
            $resultado = mysqli_query($conexion, "SELECT * from creatura WHERE creador = '$creador' LIMIT $cantidad");
            return $resultado;
        } else {
            $resultado = mysqli_query($conexion, "SELECT * from creatura LIMIT $cantidad");
            return $resultado;
        }
    }

    function alta_creatura($nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico, $conexion)
    {
        $query = "INSERT INTO creatura (nombre_creatura, id_tipo1, id_tipo2, descripcion, hp, atk, def, spa, sdef, spe, creador, imagen, publico)
        VALUES ('$nombre_creatura', $id_tipo1, $id_tipo2, '$descripcion',$hp, $atk, $def, $spa, $sdef, $spe, '$creador', '$imagen', $publico)";
        return mysqli_query($conexion, $query);
    }

    function baja_creatura($id_creatura, $conexion)
    {
        $query = "DELETE FROM creatura WHERE id_creatura = $id_creatura";
        return mysqli_query($conexion, $query);
    }

    function modificar_creatura($id_creatura, $nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico, $conexion)
    {
        $query = "UPDATE creatura SET nombre_creatura = '$nombre_creatura', id_tipo1 = $id_tipo1, id_tipo2 = $id_tipo2, descripcion = '$descripcion', hp = $hp, atk = $atk, def = $def, spa = $spa, sdef = $sdef, spe = $spe, creador = '$creador', imagen = '$imagen', publico = $publico WHERE id_creatura = $id_creatura";
        return mysqli_query($conexion, $query);
    }

    function rating_promedio($id_creatura, $conexion)
    {
        $query = "SELECT AVG(estrellas) as promedio FROM rating WHERE id_creatura = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_creatura);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return round($fila['promedio'], 2); // redondeo a 2 decimales
        } else {
            return 0.0;
        }
    }

    function retornar_creatura($nombre_creatura, $creador, $conexion)
    {
        $query = "SELECT * FROM creatura WHERE nombre_creatura = ? AND creador = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ss", $nombre_creatura, $creador);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $creatura = mysqli_fetch_assoc($resultado);
            $creatura['rating_promedio'] = $this->rating_promedio($creatura['id_creatura'], $conexion);
            return $creatura;
        } else {
            return false;
        }
    }

    function retornar_habilidades($id_creatura, $conexion)
    {
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

    function retornar_calculo_de_tipos_defendiendo($id_tipo1, $id_tipo2, $conexion)
    {

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

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// ABM DE HABILIDAD ////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function alta_habilidad($nombre_habilidad, $id_tipo_habilidad, $descripcion, $categoria_habilidad, $potencia, $creador, $conexion)
    {
        $query = "INSERT INTO habilidad (nombre_habilidad, id_tipo_habilidad, descripcion, categoria_habilidad, potencia, creador
    ) VALUES (
        '$nombre_habilidad', $id_tipo_habilidad, '$descripcion', '$categoria_habilidad', $potencia, '$creador'
    )";

        if (mysqli_query($conexion, $query)) {
            return 1; // Éxito
        } else {
            return 0; // Error
        }
    }

    function baja_habilidad($id_habilidad, $conexion)
    {
        $query = "DELETE FROM habilidad WHERE id_habilidad = $id_habilidad";
        return mysqli_query($conexion, $query);
    }

    function modificar_habilidad($id_habilidad, $nombre_habilidad, $id_tipo_habilidad, $descripcion, $categoria_habilidad, $potencia, $creador, $conexion)
    {
        $query = "UPDATE habilidad SET
        nombre_habilidad = '$nombre_habilidad',
        id_tipo_habilidad = $id_tipo_habilidad,
        descripcion = '$descripcion',
        categoria_habilidad = '$categoria_habilidad',
        potencia = $potencia,
        creador = '$creador'
    WHERE id_habilidad = $id_habilidad";

        return mysqli_query($conexion, $query);
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// AB DE MOVESET ///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function alta_moveset($id_creatura, $id_habilidad, $conexion)
    {
        $query = "INSERT INTO moveset (
        id_creatura, id_habilidad
    ) VALUES (
        $id_creatura, $id_habilidad
    )";

        return mysqli_query($conexion, $query);
    }

    function baja_moveset($id_moveset, $conexion)
    {
        $query = "DELETE FROM moveset WHERE id_moveset = $id_moveset";
        return mysqli_query($conexion, $query);
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// ABM DE RATING ///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function alta_rating($nickname_usuario, $id_creatura, $estrellas, $conexion)
    {
        $query = "INSERT INTO rating (
        nickname_usuario, id_creatura, estrellas
    ) VALUES (
        '$nickname_usuario', $id_creatura, $estrellas
    )";

        return mysqli_query($conexion, $query);
    }

    function baja_rating($id_rating, $conexion)
    {
        $query = "DELETE FROM rating WHERE id_rating = $id_rating";
        return mysqli_query($conexion, $query);
    }

    function modificar_rating($nickname_usuario, $id_creatura, $estrellas, $conexion)
    {
        $query = "UPDATE rating SET
        nickname_usuario = '$nickname_usuario',
        id_creatura = $id_creatura,
        estrellas = $estrellas
    WHERE nickname_usuario = '$nickname_usuario' AND id_creatura = $id_creatura";

        return mysqli_query($conexion, $query);
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

}

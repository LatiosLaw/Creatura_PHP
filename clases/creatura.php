<?php

require_once(__DIR__ . "/conexion.php");

class Creatura
{
    private $conexionHandler;
    private $conexion;

    public function __construct()
    {
        $this->conexionHandler = new Conexion();
        // Usa el archivo de conexión para inicializar la propiedad
        $this->conexion = $this->conexionHandler->conectar(); // Asegurate que `conectar()` devuelve la conexión
    }

    function listar_creaturas()
    {
        $resultado = mysqli_query($this->conexion, "SELECT * from creatura");
        return $resultado;
    }

    public function listar_creaturas_con_tipos_API($controladorTipo) {

    $resultado = mysqli_query($this->conexion, "SELECT * FROM creatura");
    $creaturas = [];

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
            $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2']);

            $fila['tipo1'] = $tipo1;
            $fila['tipo2'] = $tipo2;
			
			//temas de imagen
			$imgDir = __DIR__ ."../../imagenes/creaturas/". $fila['imagen'];
				$imagenCreatura = $fila['imagen'];
				if(!empty($imagenCreatura)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$fila['imagen'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			//fin de temas de imagen

            $creaturas[] = $fila;
        }
    }
    return $creaturas;
}
        function buscar_creaturas_default2($parametro,$controladorTipo)
{
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT * FROM creatura 
         WHERE creador = 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '{$param_escaped}%')
        UNION
        (SELECT * FROM creatura 
         WHERE creador = 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '%{$param_escaped}%' 
         AND nombre_creatura NOT LIKE '{$param_escaped}%')
    ";

    $resultado = mysqli_query($this->conexion, $sql);
	$creaturas = [];
	 while ($fila = mysqli_fetch_assoc($resultado)) {
        // Obtener datos del tipo1
        $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
        $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2']);

        $imagen_formateada = null;
        $imgDir = __DIR__ ."../../imagenes/creaturas/". $fila['imagen'];
			//temas de imagen
				$imagenCreatura = $fila['imagen'];
				if(!empty($imagenCreatura)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$imagen_formateada = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			//fin de temas de imagen

            $rating = $this->rating_promedio($fila['id_creatura']);

        $creaturas[] = [
            'id_creatura' => $fila['id_creatura'],
            'nombre' => $fila['nombre_creatura'],
			'creador' => $fila['creador'],
            'imagen' => $imagen_formateada,
            'rating' => $rating,
            'tipo1' => $tipo1,
            'tipo2' => $tipo2
        ];
    }
	
	
	
	
	
	
    return $creaturas;
}
    function listar_creaturas_ext($cantidad, $creador)
    {

        if ($creador != null) {
            $resultado = mysqli_query($this->conexion, "SELECT * from creatura WHERE creador = '$creador' LIMIT $cantidad");
            return $resultado;
        } else {
            $resultado = mysqli_query($this->conexion, "SELECT * from creatura LIMIT $cantidad");
            return $resultado;
        }
    }

    function listar_creaturas_usuarios_aleatorios()
    {
            $resultado = mysqli_query($this->conexion, "SELECT * from creatura WHERE creador != 'SYSTEM' AND publico = 1 ORDER BY RAND() LIMIT 30");
            return $resultado;
    }

        function buscar_creaturas_default($parametro)
{
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT * FROM creatura 
         WHERE creador = 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '{$param_escaped}%')
        UNION
        (SELECT * FROM creatura 
         WHERE creador = 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '%{$param_escaped}%' 
         AND nombre_creatura NOT LIKE '{$param_escaped}%')
    ";

    $resultado = mysqli_query($this->conexion, $sql);
    return $resultado;
}

function buscar_creaturas($parametro)
{
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT *, 1 AS orden_prioridad FROM creatura 
         WHERE creador != 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '{$param_escaped}%' )

        UNION

        (SELECT *, 2 AS orden_prioridad FROM creatura 
         WHERE creador != 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '%{$param_escaped}%' 
         AND nombre_creatura NOT LIKE '{$param_escaped}%' )

        ORDER BY orden_prioridad, nombre_creatura ASC
    ";

    $resultado = mysqli_query($this->conexion, $sql);
    return $resultado;
}
function buscar_creaturas2($parametro,$controladorTipo)
{
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT *, 1 AS orden_prioridad FROM creatura 
         WHERE creador != 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '{$param_escaped}%' )

        UNION

        (SELECT *, 2 AS orden_prioridad FROM creatura 
         WHERE creador != 'SYSTEM' AND publico = 1
         AND nombre_creatura LIKE '%{$param_escaped}%' 
         AND nombre_creatura NOT LIKE '{$param_escaped}%' )

        ORDER BY orden_prioridad, nombre_creatura ASC
    ";

    $resultado = mysqli_query($this->conexion, $sql);
	
	$creaturas = [];
	 while ($fila = mysqli_fetch_assoc($resultado)) {
        // Obtener datos del tipo1
        $tipo1 = $controladorTipo->retornar_tipo($fila['id_tipo1']);
        $tipo2 = $controladorTipo->retornar_tipo($fila['id_tipo2']);

        $imagen_formateada = null;
        $imgDir = __DIR__ ."../../imagenes/creaturas/". $fila['imagen'];
			//temas de imagen
				$imagenCreatura = $fila['imagen'];
				if(!empty($imagenCreatura)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$imagen_formateada = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			//fin de temas de imagen

            $rating = $this->rating_promedio($fila['id_creatura']);

        $creaturas[] = [
            'id_creatura' => $fila['id_creatura'],
            'nombre' => $fila['nombre_creatura'],
			'creador' => $fila['creador'],
            'imagen' => $imagen_formateada,
            'rating' => $rating,
            'tipo1' => $tipo1,
            'tipo2' => $tipo2
        ];
    }
	
	
	
	
	
	
    return $creaturas;
}
function retornar_creaturas_habilidad($id_habilidad)
{
    $id_habilidad = mysqli_real_escape_string($this->conexion, $id_habilidad);

    $sql = "
        SELECT c.* 
        FROM creatura c
        INNER JOIN moveset m ON c.id_creatura = m.id_creatura
        WHERE m.id_habilidad = '$id_habilidad'
    ";

    $resultado = mysqli_query($this->conexion, $sql);

    return $resultado;
}

   function alta_creatura($nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico)
{
    $query = "INSERT INTO creatura (nombre_creatura, id_tipo1, id_tipo2, descripcion, hp, atk, def, spa, sdef, spe, creador, imagen, publico)
              VALUES ('$nombre_creatura', $id_tipo1, $id_tipo2, '$descripcion', $hp, $atk, $def, $spa, $sdef, $spe, '$creador', '$imagen', $publico)";
    
    if (mysqli_query($this->conexion, $query)) {
        return mysqli_insert_id($this->conexion); // Retorna el ID del nuevo registro
    } else {
        return 0; // Algo falló
    }
}

function alta_creatura_API($nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico)
{
    $query = "INSERT INTO creatura (nombre_creatura, id_tipo1, id_tipo2, descripcion, hp, atk, def, spa, sdef, spe, creador, imagen, publico)
              VALUES ('$nombre_creatura', $id_tipo1, $id_tipo2, '$descripcion', $hp, $atk, $def, $spa, $sdef, $spe, '$creador', '$imagen', $publico)";
    
    if (mysqli_query($this->conexion, $query)) {
        return mysqli_insert_id($this->conexion); // Retorna el ID del nuevo registro
    } else {
        return 0; // Algo falló
    }
}

    function borrar_moveset_por_creatura($id_creatura)
{
    // Obtener todos los registros del moveset relacionados
    $query_moves = "SELECT id_moveset FROM moveset WHERE id_creatura = $id_creatura";
    $result = mysqli_query($this->conexion, $query_moves);

    if (!$result) return false;

    // Guardar los ids en un array
    $ids_moveset = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $ids_moveset[] = intval($fila['id_moveset']);
    }

    // Eliminar registros si hay alguno
    if (!empty($ids_moveset)) {
        $ids_str = implode(',', $ids_moveset);
        $delete_moves = "DELETE FROM moveset WHERE id_moveset IN ($ids_str)";
        return mysqli_query($this->conexion, $delete_moves);
    }

    return true; // No había moveset, pero no es un error
}

function borrar_moveset_por_creatura_API($id_creatura)
{
    // Obtener todos los registros del moveset relacionados
    $query_moves = "SELECT id_moveset FROM moveset WHERE id_creatura = $id_creatura";
    $result = mysqli_query($this->conexion, $query_moves);

    if (!$result) return false;

    // Guardar los ids en un array
    $ids_moveset = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $ids_moveset[] = intval($fila['id_moveset']);
    }

    // Eliminar registros si hay alguno
    if (!empty($ids_moveset)) {
        $ids_str = implode(',', $ids_moveset);
        $delete_moves = "DELETE FROM moveset WHERE id_moveset IN ($ids_str)";
        return mysqli_query($this->conexion, $delete_moves);
    }

    return true; // No había moveset, pero no es un error
}

function baja_creatura($id_creatura)
{
    $this->borrar_moveset_por_creatura($id_creatura); // Llamada a la función separada

    // Finalmente eliminar la creatura
    $query = "DELETE FROM creatura WHERE id_creatura = $id_creatura";
    return mysqli_query($this->conexion, $query);
}

function baja_creatura_API($id_creatura)
{
    $this->borrar_moveset_por_creatura($id_creatura); // Llamada a la función separada

    // Finalmente eliminar la creatura
    $query = "DELETE FROM creatura WHERE id_creatura = $id_creatura";
    return mysqli_query($this->conexion, $query);
}

    function modificar_creatura($id_creatura, $nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico)
    {
        $query = "UPDATE creatura SET nombre_creatura = '$nombre_creatura', id_tipo1 = $id_tipo1, id_tipo2 = $id_tipo2, descripcion = '$descripcion', hp = $hp, atk = $atk, def = $def, spa = $spa, sdef = $sdef, spe = $spe, creador = '$creador', imagen = '$imagen', publico = $publico WHERE id_creatura = $id_creatura";
        return mysqli_query($this->conexion, $query);
    }

    function modificar_creatura_API($id_creatura, $nombre_creatura, $id_tipo1, $id_tipo2, $descripcion, $hp, $atk, $def, $spa, $sdef, $spe, $creador, $imagen, $publico)
    {
        $query = "UPDATE creatura SET nombre_creatura = '$nombre_creatura', id_tipo1 = $id_tipo1, id_tipo2 = $id_tipo2, descripcion = '$descripcion', hp = $hp, atk = $atk, def = $def, spa = $spa, sdef = $sdef, spe = $spe, creador = '$creador', imagen = '$imagen', publico = $publico WHERE id_creatura = $id_creatura";
        return mysqli_query($this->conexion, $query);
    }

    function rating_promedio($id_creatura)
    {
        $query = "SELECT AVG(estrellas) as promedio FROM rating WHERE id_creatura = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_creatura);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return round($fila['promedio'], 2); // redondeo a 2 decimales
        } else {
            return 0.0;
        }
    }

    function retornar_creatura($nombre_creatura, $creador)
    {
        $query = "SELECT * FROM creatura WHERE nombre_creatura = ? AND creador = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "ss", $nombre_creatura, $creador);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $creatura = mysqli_fetch_assoc($resultado);
            $creatura['rating_promedio'] = $this->rating_promedio($creatura['id_creatura']);
            return $creatura;
        } else {
            return false;
        }
    }

    function retornar_creatura_API($id_creatura)
    {	
		require_once("tipo.php");
		$controladorTipo = new Tipo();
        $query = "SELECT * FROM creatura WHERE id_creatura = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_creatura);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
		
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $creatura = mysqli_fetch_assoc($resultado);
			
			$tipo1 = $controladorTipo->retornar_tipo($creatura['id_tipo1']);
            $tipo2 = $controladorTipo->retornar_tipo($creatura['id_tipo2']);

            $creatura['tipo1'] = $tipo1;
            $creatura['tipo2'] = $tipo2;
			
			
            $creatura['rating_promedio'] = $this->rating_promedio($creatura['id_creatura']);
			$imgDir = __DIR__ ."../../imagenes/creaturas/". $creatura['imagen'];
			//temas de imagen
				$imagenCreatura = $creatura['imagen'];
				if(!empty($imagenCreatura)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$creatura['imagen'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			//fin de temas de imagen
            return $creatura;
        } else {
            return false;
        }
    }

    function retornar_habilidades($id_creatura)
{
    $query = "
        SELECT 
            h.*, 
            t.nombre_tipo AS nombre_tipo_habilidad,
            t.color AS color_tipo_habilidad,
            t.icono AS icono_tipo_habilidad
        FROM moveset m
        INNER JOIN habilidad h ON m.id_habilidad = h.id_habilidad
        INNER JOIN tipo t ON h.id_tipo_habilidad = t.id_tipo
        WHERE m.id_creatura = $id_creatura
    ";

    $resultado = mysqli_query($this->conexion, $query);
    $habilidades = [];

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $habilidades[] = $fila;
        }
    }

    return $habilidades;
}

function retornar_habilidades_API($id_creatura)
{
    $query = "
        SELECT 
            h.*, 
            t.nombre_tipo AS nombre_tipo_habilidad,
            t.color AS color_tipo_habilidad,
            t.icono AS icono_tipo_habilidad
        FROM moveset m
        INNER JOIN habilidad h ON m.id_habilidad = h.id_habilidad
        INNER JOIN tipo t ON h.id_tipo_habilidad = t.id_tipo
        WHERE m.id_creatura = $id_creatura
    ";

    $resultado = mysqli_query($this->conexion, $query);
    $habilidades = [];

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $habilidades[] = $fila;
        }
    }

    return $habilidades;
}

public function retornar_habilidad($nombre_habilidad, $creador)
{
    // Prepara la consulta para mayor seguridad
    $sql = "SELECT * 
            FROM habilidad 
            WHERE nombre_habilidad = ? 
              AND creador = ? 
            LIMIT 1";
    $stmt = $this->conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
    }

    // Enlaza parámetros y ejecuta
    $stmt->bind_param("ss", $nombre_habilidad, $creador);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Obtiene el resultado y el primer registro
    $res = $stmt->get_result();
    $fila = $res->fetch_assoc();

    $stmt->close();

    // Devuelve el array asociativo o null si no existe
    return $fila ?: null;
}

public function retornar_habilidad_id($id_habilidad)
{
    // 1. Consulta con JOIN
    $sql = "
        SELECT 
            h.*, 
            t.id_tipo       AS tipo_id,
            t.nombre_tipo   AS tipo_nombre,
            t.color         AS tipo_color,
            t.icono         AS tipo_icono,
            t.creador       AS tipo_creador
        FROM habilidad h
        LEFT JOIN tipo t ON h.id_tipo_habilidad = t.id_tipo
        WHERE h.id_habilidad = ?
        LIMIT 1
    ";

    $stmt = $this->conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
    }

    $stmt->bind_param("i", $id_habilidad);

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    $res  = $stmt->get_result();
    $fila = $res->fetch_assoc();
    $stmt->close();

    /* ---------------------------------------------------
     *  2.  Convertir ícono en Base64 (si existe archivo)
     * ---------------------------------------------------*/
    if ($fila && !empty($fila['tipo_icono'])) {
        $rutaIcono = __DIR__ . "../../imagenes/tipos/" . $fila['tipo_icono'];

        if (file_exists($rutaIcono)) {
            $mime  = mime_content_type($rutaIcono);           // ej: image/png
            $bytes = file_get_contents($rutaIcono);
            $fila['tipo_icono_base64'] = "data:$mime;base64," . base64_encode($bytes);
        } else {
            // Si el archivo no existe, podrías setear null o un placeholder
            $fila['tipo_icono_base64'] = "";
        }
    }

    return $fila ?: null;    // array asociativo o null
}


function retornar_habilidades_creador($nickname)
{
    $nickname = mysqli_real_escape_string($this->conexion, $nickname);

    $query = "
        SELECT 
            h.*, 
            t.id_tipo       AS tipo_id,
            t.nombre_tipo   AS tipo_nombre,
            t.color         AS tipo_color,
            t.icono         AS tipo_icono,
            t.creador       AS tipo_creador
        FROM habilidad h
        INNER JOIN tipo t ON h.id_tipo_habilidad = t.id_tipo
        WHERE h.creador = '$nickname'
    ";

    $resultado = mysqli_query($this->conexion, $query);
    $habilidades = [];

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Convertir ícono en base64 si existe
            $icono_base64 = null;
            if (!empty($fila['tipo_icono'])) {
                $ruta = __DIR__ . "/../imagenes/tipos/" . $fila['tipo_icono'];
                if (file_exists($ruta)) {
                    $mime = mime_content_type($ruta);
                    $data = file_get_contents($ruta);
                    $icono_base64 = "data:$mime;base64," . base64_encode($data);
                }
            }

            // Agrupar los datos del tipo
            $fila['tipo'] = [
                'id'            => $fila['tipo_id'],
                'nombre'        => $fila['tipo_nombre'],
                'color'         => $fila['tipo_color'],
                'icono'         => $fila['tipo_icono'],           // (opcional: se puede eliminar)
                'icono_base64'  => $icono_base64,
                'creador'       => $fila['tipo_creador']
            ];

            // Eliminar los campos duplicados
            unset(
                $fila['tipo_id'],
                $fila['tipo_nombre'],
                $fila['tipo_color'],
                $fila['tipo_icono'],
                $fila['tipo_creador']
            );

            $habilidades[] = $fila;
        }
    }

    return $habilidades;
}

   function retornar_tipos_de_creatura($id_creatura)
{
    // Obtener los IDs de los tipos de la creatura
    $query = "SELECT id_tipo1, id_tipo2 FROM creatura WHERE id_creatura = ?";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_creatura);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        // Consultar detalles de los tipos
        $tipo1 = mysqli_query($this->conexion, "SELECT * FROM tipo WHERE id_tipo = {$fila['id_tipo1']}");
        $tipo2 = mysqli_query($this->conexion, "SELECT * FROM tipo WHERE id_tipo = {$fila['id_tipo2']}");

        return [
            'tipo1' => ($tipo1 && mysqli_num_rows($tipo1) > 0) ? mysqli_fetch_assoc($tipo1) : null,
            'tipo2' => ($tipo2 && mysqli_num_rows($tipo2) > 0) ? mysqli_fetch_assoc($tipo2) : null
        ];
    }

    return null; // Creatura no encontrada
}

    function retornar_calculo_de_tipos_defendiendo($id_tipo1, $id_tipo2)
{
    // Primero obtenemos todos los tipos atacantes
    $tipos = [];
    $consulta_tipos = mysqli_query($this->conexion, "SELECT * FROM tipo");
    while ($tipo = mysqli_fetch_assoc($consulta_tipos)) {
        $tipos[$tipo['id_tipo']] = $tipo;
        $tipos[$tipo['id_tipo']]['multiplicador1'] = 1.0;
        $tipos[$tipo['id_tipo']]['multiplicador2'] = 1.0;
    }

    // Efectividades sobre el tipo1
    $ef1 = mysqli_query($this->conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo1");
    while ($fila = mysqli_fetch_assoc($ef1)) {
        if (isset($tipos[$fila['atacante']])) {
            $tipos[$fila['atacante']]['multiplicador1'] = $fila['multiplicador'];
        }
    }

    // Efectividades sobre el tipo2
    $ef2 = mysqli_query($this->conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo2");
    while ($fila = mysqli_fetch_assoc($ef2)) {
        if (isset($tipos[$fila['atacante']])) {
            $tipos[$fila['atacante']]['multiplicador2'] = $fila['multiplicador'];
        }
    }

    // Resultado final
    $resultado = [];

    foreach ($tipos as $id => $tipo) {
        $m1 = $tipo['multiplicador1'];
        $m2 = $tipo['multiplicador2'];

        // Inmunidad prevalece
        $total = ($m1 == 0 || $m2 == 0) ? 0 : $m1 * $m2;

        $resultado[] = [
            'id_tipo' => $id,
            'nombre_tipo' => $tipo['nombre_tipo'],
            'color' => $tipo['color'],
            'icono' => $tipo['icono'],
            'creador' => $tipo['creador'],
            'multiplicador' => $total
        ];
    }

    return $resultado;
}

function retornar_calculo_de_tipos_defendiendo_API($id_tipo1, $id_tipo2)
{
    // Primero obtenemos todos los tipos atacantes
    $tipos = [];
    $consulta_tipos = mysqli_query($this->conexion, "SELECT * FROM tipo");
    while ($tipo = mysqli_fetch_assoc($consulta_tipos)) {
        $tipos[$tipo['id_tipo']] = $tipo;
        $tipos[$tipo['id_tipo']]['multiplicador1'] = 1.0;
        $tipos[$tipo['id_tipo']]['multiplicador2'] = 1.0;
    }

    // Efectividades sobre el tipo1
    $ef1 = mysqli_query($this->conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo1");
    while ($fila = mysqli_fetch_assoc($ef1)) {
        if (isset($tipos[$fila['atacante']])) {
            $tipos[$fila['atacante']]['multiplicador1'] = $fila['multiplicador'];
        }
    }

    // Efectividades sobre el tipo2
    $ef2 = mysqli_query($this->conexion, "SELECT * FROM efectividades WHERE defensor = $id_tipo2");
    while ($fila = mysqli_fetch_assoc($ef2)) {
        if (isset($tipos[$fila['atacante']])) {
            $tipos[$fila['atacante']]['multiplicador2'] = $fila['multiplicador'];
        }
    }

    // Resultado final
    $resultado = [];

    foreach ($tipos as $id => $tipo) {
        $m1 = $tipo['multiplicador1'];
        $m2 = $tipo['multiplicador2'];

        // Inmunidad prevalece
        $total = ($m1 == 0 || $m2 == 0) ? 0 : $m1 * $m2;

        $resultado[] = [
            'id_tipo' => $id,
            'nombre_tipo' => $tipo['nombre_tipo'],
            'color' => $tipo['color'],
            'icono' => $tipo['icono'],
            'creador' => $tipo['creador'],
            'multiplicador' => $total
        ];
    }

    return $resultado;
}

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// ABM DE HABILIDAD ////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function alta_habilidad($nombre_habilidad, $id_tipo_habilidad, $descripcion, $categoria_habilidad, $potencia, $creador)
    {
        $query = "INSERT INTO habilidad (nombre_habilidad, id_tipo_habilidad, descripcion, categoria_habilidad, potencia, creador
    ) VALUES (
        '$nombre_habilidad', $id_tipo_habilidad, '$descripcion', '$categoria_habilidad', $potencia, '$creador'
    )";

        if (mysqli_query($this->conexion, $query)) {
            return 1; // Éxito
        } else {
            return 0; // Error
        }
    }

    function baja_habilidad($id_habilidad)
    {
        $query = "DELETE FROM habilidad WHERE id_habilidad = $id_habilidad";
        return mysqli_query($this->conexion, $query);
    }

    function modificar_habilidad($id_habilidad, $nombre_habilidad, $id_tipo_habilidad, $descripcion, $categoria_habilidad, $potencia, $creador)
    {
        $query = "UPDATE habilidad SET
        nombre_habilidad = '$nombre_habilidad',
        id_tipo_habilidad = $id_tipo_habilidad,
        descripcion = '$descripcion',
        categoria_habilidad = '$categoria_habilidad',
        potencia = $potencia,
        creador = '$creador'
    WHERE id_habilidad = $id_habilidad";

        return mysqli_query($this->conexion, $query);
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// AB DE MOVESET ///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function alta_moveset($id_creatura, $id_habilidad)
    {
        $query = "INSERT INTO moveset (
        id_creatura, id_habilidad
    ) VALUES (
        $id_creatura, $id_habilidad
    )";

        return mysqli_query($this->conexion, $query);
    }

    function alta_moveset_API($id_creatura, $id_habilidad)
    {
        $query = "INSERT INTO moveset (
        id_creatura, id_habilidad
    ) VALUES (
        $id_creatura, $id_habilidad
    )";

        return mysqli_query($this->conexion, $query);
    }

    function baja_moveset($id_moveset)
    {
        $query = "DELETE FROM moveset WHERE id_moveset = $id_moveset";
        return mysqli_query($this->conexion, $query);
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////// ABM DE RATING ///////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

public function guardar_o_actualizar_rating($usuario, $id_creatura, $puntaje) {
    // $puntaje es float
    $query = "INSERT INTO rating (nickname_usuario, id_creatura, estrellas) VALUES (?, ?, ?)
              ON DUPLICATE KEY UPDATE estrellas = ?";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "sidd", $usuario, $id_creatura, $puntaje, $puntaje);
    $ok = mysqli_stmt_execute($stmt);
    return $ok;
}

    function baja_rating($id_rating)
    {
        $query = "DELETE FROM rating WHERE id_rating = $id_rating";
        return mysqli_query($this->conexion, $query);
    }

    function listar_ratings_usuario($usuario)
    {
        $query = "SELECT * FROM rating WHERE nickname_usuario = '$usuario'";
        return mysqli_query($this->conexion, $query);
    }

public function retornar_rating($nickname, $id_creatura) {
    $query = "SELECT estrellas FROM rating WHERE nickname_usuario = ? AND id_creatura = ?";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "si", $nickname, $id_creatura);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        return $fila; // <-- clave
    }
    return 0;
}



    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

}

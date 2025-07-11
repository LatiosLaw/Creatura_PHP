<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir los archivos de PHPMailer
require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/Exception.php';

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

    if (mysqli_stmt_execute($stmt)) {
        // Inserción exitosa, enviar correo
        $this->enviar_correo_bienvenida($correo); // Podés pasarle lo que necesites
        return 1;
    }

    return 0;
}

function alta_usuario_API($nickname, $correo, $foto, $biografia, $contraseña, $tipo) {
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

function baja_usuario_API($nickname) {
    $query = "DELETE FROM usuario WHERE nickname = '$nickname'";
    $resultado = mysqli_query($this->conexion, $query);

    if ($resultado && mysqli_affected_rows($this->conexion) > 0) {
        return 1; // Eliminación exitosa
    } else {
        return 0; // Fallo: o no existía el usuario o error en la query
    }
}

function modificar_usuario($nickname, $correo, $foto, $biografia, $contraseña, $tipo) {
    $query = "UPDATE usuario SET
        correo = '$correo',
        foto = '$foto',
        biografia = '$biografia',
        contraseña = '$contraseña',
        tipo = '$tipo'
    WHERE nickname = '$nickname'";

    $resultado = mysqli_query($this->conexion, $query);

    return $resultado ? 1 : 0;
}

function verificar_disponibilidad($nickname, $correo, $nick_viejo, $correo_viejo) {
    $query = "SELECT nickname, correo FROM usuario WHERE (nickname = ? OR correo = ?)";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $nickname, $correo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Si el nickname o correo encontrados no coinciden con los anteriores, entonces están en uso por otro usuario
        if (
            ($fila['nickname'] !== $nick_viejo) &&
            ($fila['correo'] !== $correo_viejo)
        ) {
            return 0; // No disponible
        }
    }

    return 1; // Disponible
}

  function listar_usuarios() {
    $resultado = mysqli_query($this->conexion, "SELECT nickname, foto, biografia from usuario");
    return $resultado;
  }
  
  function listar_usuarios_api() {
    $resultado = mysqli_query($this->conexion, "SELECT nickname, foto, biografia from usuario");
    
	$usuarios = [];
	
	while ($fila = mysqli_fetch_assoc($resultado)) {
	
    $imgDir = __DIR__ ."../../imagenes/usuarios/". $fila['foto'];
			//temas de imagen
				$imagenUsuario = $fila['foto'];
				if(!empty($imagenUsuario)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$fila['foto'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
				}

        $usuarios[] = [
            'nickname' => $fila['nickname'],
            'foto' => $fila['foto'],
			'biografia' => $fila['biografia']
        ];
    }
	
    return $usuarios;
	
  }

  function listar_usuarios_creadores() {
    $query = "
        SELECT u.nickname, u.foto, u.biografia
        FROM usuario u
        INNER JOIN creatura c ON u.nickname = c.creador
        WHERE u.nickname != 'SYSTEM'
        GROUP BY u.nickname
    ";
    
    $resultado = mysqli_query($this->conexion, $query);
    return $resultado;
}

function listar_usuarios_creadores_aleatorios() {
    $query = "
        SELECT u.nickname, u.foto, u.biografia
        FROM usuario u
        INNER JOIN creatura c ON u.nickname = c.creador
        WHERE u.nickname != 'SYSTEM'
        GROUP BY u.nickname ORDER BY RAND() LIMIT 10
    ";
    
    $resultado = mysqli_query($this->conexion, $query);
    return $resultado;
}

function enviar_correo_bienvenida($correo_usuario) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mexacraftt200@gmail.com';
        $mail->Password = 'imnubxerpvjahfzw'; // Asegurate que sea una App Password si usás Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('mexacraftt200@gmail.com', 'Creatura Dev Team');
        $mail->addAddress($correo_usuario);
        $mail->Subject = 'Creatura - Registro';
        $mail->isHTML(true);
        $mail->Body = '
            <h1>¡Gracias por registrarte y bienvenido a Creatura!</h1>
            <p>Esperamos que disfrutes creando y compartiendo tus criaturas con tus amigos y el resto de la comunidad.</p>
            <p>Atte. Creatura Dev Team</p>
        ';
        $mail->AltBody = 'Gracias por registrarte en Creatura. ¡Bienvenido!';

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}

  function listar_usuarios_busqueda($parametro) {
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT nickname, foto, biografia 
         FROM usuario 
         WHERE nickname LIKE '{$param_escaped}%' AND nickname != 'SYSTEM')
        UNION
        (SELECT nickname, foto, biografia 
         FROM usuario 
         WHERE nickname LIKE '%{$param_escaped}%' 
         AND nickname NOT LIKE '{$param_escaped}%' 
         AND nickname != 'SYSTEM')
    ";

    $resultado = mysqli_query($this->conexion, $sql);
    return $resultado;
}
  function listar_usuarios_busqueda2($parametro) {
    $param_escaped = mysqli_real_escape_string($this->conexion, $parametro);

    $sql = "
        (SELECT nickname, foto, biografia 
         FROM usuario 
         WHERE nickname LIKE '{$param_escaped}%' AND nickname != 'SYSTEM')
        UNION
        (SELECT nickname, foto, biografia 
         FROM usuario 
         WHERE nickname LIKE '%{$param_escaped}%' 
         AND nickname NOT LIKE '{$param_escaped}%' 
         AND nickname != 'SYSTEM')
    ";
	
    $resultado = mysqli_query($this->conexion, $sql);

	$usuarios = [];
	
	while ($fila = mysqli_fetch_assoc($resultado)) {
	
    $imgDir = __DIR__ ."../../imagenes/usuarios/". $fila['foto'];
			//temas de imagen
				$imagenUsuario = $fila['foto'];
				if(!empty($imagenUsuario)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$fila['foto'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
				}

        $usuarios[] = [
            'nickname' => $fila['nickname'],
            'foto' => $fila['foto'],
			'biografia' => $fila['biografia']
        ];
    }
	
    return $usuarios;
}
  function retornar_usuario_personal($nickname){
    $resultado = mysqli_query($this->conexion, "SELECT * from usuario WHERE nickname = '$nickname'");
    return mysqli_fetch_assoc($resultado);
  }

  function retornar_usuario_personal_API($nickname){
    $resultado = mysqli_query($this->conexion, "SELECT * from usuario WHERE nickname = '$nickname'");
    $usuario = mysqli_fetch_assoc($resultado);

    $imgDir = __DIR__ ."../../imagenes/usuarios/". $usuario['foto'];
			//temas de imagen
				$imagenUsuario = $usuario['foto'];
				if(!empty($imagenUsuario)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$usuario['foto'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
				}
    return $usuario;
  }

  function retornar_informacion_usuario($nickname){
    $resultado = mysqli_query($this->conexion, "SELECT nickname, correo, biografia, foto from usuario WHERE nickname = '$nickname'");
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
            'imagen' => $fila['imagen'],
            'tipo1' => $tipo1,
            'tipo2' => $tipo2
        ];
    }

    return $creaturas;
}

function listar_creaturas_de_usuario_solo_pub($nickname, $controladorTipo) {
        
    // Consulta todas las criaturas del creador
    $query = "SELECT * FROM creatura WHERE creador = ? AND publico = 1";
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
            'imagen' => $fila['imagen'],
            'tipo1' => $tipo1,
            'tipo2' => $tipo2
        ];
    }

    return $creaturas;
}

function listar_creaturas_de_usuario_API($nickname, $controladorTipo, $controladorCreatura) {
        
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
						//imagen tipos momento
			
				$imgDir = __DIR__ ."../../imagenes/tipos/". $tipo1['icono'];
				$imagenTipo = $tipo1['icono'];
				if(!empty($imagenTipo)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$tipo1['icono'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			///////
				$imgDir = __DIR__ ."../../imagenes/tipos/". $tipo2['icono'];
				$imagenTipo = $tipo2['icono'];
				if(!empty($imagenTipo)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$tipo2['icono'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			
			//imagen tipos momento fin
            $rating = $controladorCreatura->rating_promedio($fila['id_creatura']);

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
function listar_creaturas_de_usuario_API_PublicoOnlyFans($nickname, $controladorTipo, $controladorCreatura) {
        
    // Consulta todas las criaturas del creador
    $query = "SELECT * FROM creatura WHERE creador = ? and publico = 1";
    $stmt = mysqli_prepare($this->conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $nickname);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

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
						//imagen tipos momento
			
				$imgDir = __DIR__ ."../../imagenes/tipos/". $tipo1['icono'];
				$imagenTipo = $tipo1['icono'];
				if(!empty($imagenTipo)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$tipo1['icono'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			///////
				$imgDir = __DIR__ ."../../imagenes/tipos/". $tipo2['icono'];
				$imagenTipo = $tipo2['icono'];
				if(!empty($imagenTipo)){
					if (file_exists($imgDir)) {
						$extencionIMG = mime_content_type($imgDir);
						$IMGposta = file_get_contents($imgDir);
						$tipo2['icono'] = "data:".$extencionIMG.";base64," . base64_encode($IMGposta);
					}
					
				}
			
			//imagen tipos momento fin
            $rating = $controladorCreatura->rating_promedio($fila['id_creatura']);

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

}
?>
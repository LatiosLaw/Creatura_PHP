<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once("../../clases/usuario.php");
require_once("../../clases/tipo.php");
require_once("../../clases/creatura.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (($data['metodo'] ?? '') !== 'DELETE' || !isset($data['nickname'])) {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "Faltan parámetros o método incorrecto"
        ]);
        exit;
    }

    $nickname = $data['nickname'];

    $controladorUsuario = new Usuario();
    $controladorTipo = new Tipo();
    $controladorCreatura = new Creatura();

    // 1. Eliminar habilidades y tipos creados por el usuario
$tipos = $controladorTipo->listar_tipos_creador($nickname);
if (is_array($tipos) && count($tipos) > 0) {
    foreach ($tipos as $tipo) {
        $idTipo = $tipo['id_tipo'];

        // Eliminar habilidades de ese tipo
        $habilidades = $controladorTipo->retornar_habilidades_tipo($idTipo);
        if (is_array($habilidades)) {
            foreach ($habilidades as $habilidad) {
                if (isset($habilidad['id_habilidad'])) {
                    $controladorCreatura->baja_habilidad($habilidad['id_habilidad']);
                }
            }
        }

        $criaturasAfectadas = $controladorTipo->retornar_creaturas_tipo($idTipo);

while ($crea = mysqli_fetch_assoc($criaturasAfectadas)) {
        $nuevoTipo1 = $crea['id_tipo1'];
        $nuevoTipo2 = $crea['id_tipo2'];

        if ($crea['id_tipo1'] == $idTipo) {
            if ($crea['id_tipo2'] != 0 && $crea['id_tipo2'] != $idTipo) {
                $nuevoTipo1 = $crea['id_tipo2'];
                $nuevoTipo2 = 0;
            } else {
                $nuevoTipo1 = 0;
                $nuevoTipo2 = 0;
            }
        } elseif ($crea['id_tipo2'] == $idTipo) {
            $nuevoTipo2 = 0;
        }

        if ($nuevoTipo1 == $nuevoTipo2 && $nuevoTipo1 != 0) {
            $nuevoTipo2 = 0;
        }

        $controladorCreatura->modificar_creatura(
            $crea['id_creatura'],
            $crea['nombre_creatura'],
            $nuevoTipo1,
            $nuevoTipo2,
            $crea['descripcion'],
            $crea['hp'],
            $crea['atk'],
            $crea['def'],
            $crea['spa'],
            $crea['sdef'],
            $crea['spe'],
            $crea['creador'],
            $crea['imagen'],
            $crea['publico']
        );
}

        // Eliminar efectividades y tipo
        $controladorTipo->eliminar_efectividades($idTipo);
        $controladorTipo->baja_tipo($idTipo);
    }
}

    // 2. Eliminar ratings
    $ratings = $controladorCreatura->listar_ratings_usuario($nickname);
    if ($ratings && mysqli_num_rows($ratings) > 0) {
        while ($rating = mysqli_fetch_assoc($ratings)) {
            $controladorCreatura->baja_rating($rating['id_rating']);
        }
    }

    // 3. Eliminar creaturas creadas por el usuario
    $creaturas = $controladorCreatura->listar_creaturas_ext(500, $nickname);
    if ($creaturas && mysqli_num_rows($creaturas) > 0) {
        while ($crea = mysqli_fetch_assoc($creaturas)) {
            $controladorCreatura->baja_creatura($crea['id_creatura']);
        }
    }

    // 4. Eliminar usuario
    $usuarioEliminado = $controladorUsuario->baja_usuario_API($nickname);

    if ($usuarioEliminado == 1) {
        echo json_encode([
            "resultado" => "ok",
            "mensaje" => "Cuenta eliminada exitosamente"
        ]);
    } else {
        echo json_encode([
            "resultado" => "error",
            "mensaje" => "No se pudo eliminar el usuario"
        ]);
    }
    exit;
}

http_response_code(405);
echo json_encode([
    "resultado" => "error",
    "mensaje" => "Método no permitido"
]);

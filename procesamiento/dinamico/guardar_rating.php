<?php
session_start();
require_once("../../clases/creatura.php");
$controladorCreatura = new Creatura();

if (!isset($_SESSION['nickname'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$usuario = $_SESSION['nickname'];
$id_creatura = $_POST['id_creatura'] ?? null;
$puntaje = isset($_POST['puntaje']) ? floatval($_POST['puntaje']) : null;

if (!$id_creatura || !$puntaje) {
    http_response_code(400);
    echo json_encode(['error' => 'Datos incompletos']);
    exit;
}

$ok = $controladorCreatura->guardar_o_actualizar_rating($usuario, $id_creatura, $puntaje);

if ($ok) {
    // Obtener promedio actualizado
    $nuevo_promedio = $controladorCreatura->rating_promedio($id_creatura);
    echo json_encode([
        'success' => true,
        'nuevo_promedio' => $nuevo_promedio
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al guardar el rating']);
}
exit;
?>

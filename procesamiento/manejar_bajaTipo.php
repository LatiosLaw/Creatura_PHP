<?php
require_once("../clases/tipo.php");
require_once("../clases/creatura.php");

$controladorTipo = new Tipo();
$controladorCreatura = new Creatura();

if (!isset($_GET['id_tipo'])) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=eliminar_tipo_id_invalido");
    exit();
}

$id_tipo = urldecode($_GET['id_tipo']);

$tipo = $controladorTipo->retornar_tipo($id_tipo);

if (!$tipo) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=eliminar_tipo_no_encontrado");
    exit();
}

// Eliminar habilidades relacionadas
$habilidades = $controladorTipo->retornar_habilidades_tipo($tipo['id_tipo']);
if (is_array($habilidades) && count($habilidades) > 0) {
    foreach ($habilidades as $habilidad) {
        if (isset($habilidad['id_habilidad'])) {
            $res = $controladorCreatura->baja_habilidad($habilidad['id_habilidad']);
            if (!$res) {
                header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_eliminar_habilidades");
                exit();
            }
        }
    }
}

// Modificar criaturas que usan este tipo
$criaturas_perjudicadas = $controladorTipo->retornar_creaturas_tipo($tipo['id_tipo']);
if ($criaturas_perjudicadas && mysqli_num_rows($criaturas_perjudicadas) > 0) {
    while ($pobrecito = mysqli_fetch_assoc($criaturas_perjudicadas)) {
        if ($pobrecito['id_tipo1'] == $tipo['id_tipo']) {
            $res = $controladorCreatura->modificar_creatura(
                $pobrecito['id_creatura'], $pobrecito['nombre_creatura'],
                $pobrecito['id_tipo2'], 0,
                $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'],
                $pobrecito['def'], $pobrecito['spa'], $pobrecito['sdef'],
                $pobrecito['spe'], $pobrecito['creador'], $pobrecito['imagen'],
                $pobrecito['publico']
            );
        } else {
            $res = $controladorCreatura->modificar_creatura(
                $pobrecito['id_creatura'], $pobrecito['nombre_creatura'],
                $pobrecito['id_tipo1'], 0,
                $pobrecito['descripcion'], $pobrecito['hp'], $pobrecito['atk'],
                $pobrecito['def'], $pobrecito['spa'], $pobrecito['sdef'],
                $pobrecito['spe'], $pobrecito['creador'], $pobrecito['imagen'],
                $pobrecito['publico']
            );
        }
        if (!$res) {
            header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_modificar_criaturas");
            exit();
        }
    }
}

// Eliminar efectividades
$res = $controladorTipo->eliminar_efectividades($tipo['id_tipo']);
if (!$res) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_eliminar_efectividades");
    exit();
}

// Eliminar tipo
$res = $controladorTipo->baja_tipo($tipo['id_tipo']);
if (!$res) {
    header("Location: /Creatura_PHP/paginas/gestor_tipo.php?error=fallo_eliminar_tipo");
    exit();
}

header("Location: /Creatura_PHP/paginas/gestor_tipo.php?success=eliminar_tipo_exitosa");
exit();

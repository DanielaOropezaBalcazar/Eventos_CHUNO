<?php
require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();
$id = $_GET['id'] ?? null;

if ($id && $controller->eliminar($id)) {
    header("Location: charlas.php");
    exit();
} else {
    echo "Error al eliminar la charla.";
}
?>

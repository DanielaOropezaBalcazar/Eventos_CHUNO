<?php
require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();
$id = $_GET['id'] ?? null;
$charla = $id ? $controller->obtener($id) : null;

if (!$charla) {
    die("Charla no encontrada.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        $_POST['Nombre'], $_POST['Institucion'], $_POST['idDepartamento'], 
        $_POST['idModalidad'], $_POST['Fecha'], $_POST['Hora'], 
        $_POST['LinkReunion'], $_POST['Codigo'], $_POST['LinkPresentacion'], 
        $_POST['Likes'], $_POST['Dislikes'], $_POST['Estado'], $_POST['idOrador']
    ];

    if ($controller->actualizar($id, $data)) {
        header("Location: charlas.php");
        exit();
    } else {
        echo "Error al actualizar la charla.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Charla</title>
</head>
<body>
    <h2>Editar Charla</h2>
    <form method="post">
        <label>Nombre: <input type="text" name="Nombre" value="<?= $charla['Nombre'] ?>" required></label><br>
        <label>Institución: <input type="text" name="Institucion" value="<?= $charla['Institucion'] ?>" required></label><br>
        <label>Departamento ID: <input type="number" name="idDepartamento" value="<?= $charla['idDepartamento'] ?>" required></label><br>
        <label>Modalidad ID: <input type="number" name="idModalidad" value="<?= $charla['idModalidad'] ?>" required></label><br>
        <label>Fecha: <input type="date" name="Fecha" value="<?= $charla['Fecha'] ?>" required></label><br>
        <label>Hora: <input type="time" name="Hora" value="<?= $charla['Hora'] ?>" required></label><br>
        <label>Link Reunión: <input type="text" name="LinkReunion" value="<?= $charla['LinkReunion'] ?>"></label><br>
        <label>Código: <input type="text" name="Codigo" value="<?= $charla['Codigo'] ?>"></label><br>
        <label>Link Presentación: <input type="text" name="LinkPresentacion" value="<?= $charla['LinkPresentacion'] ?>"></label><br>
        <label>Likes: <input type="number" name="Likes" value="<?= $charla['Likes'] ?>"></label><br>
        <label>Dislikes: <input type="number" name="Dislikes" value="<?= $charla['Dislikes'] ?>"></label><br>
        <label>Estado: <input type="checkbox" name="Estado" value="1" <?= $charla['Estado'] ? 'checked' : '' ?>></label><br>
        <label>Orador ID: <input type="number" name="idOrador" value="<?= $charla['idOrador'] ?>" required></label><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

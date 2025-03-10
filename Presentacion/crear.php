<?php
require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        $_POST['Nombre'], $_POST['Institucion'], $_POST['idDepartamento'], 
        $_POST['idModalidad'], $_POST['Fecha'], $_POST['Hora'], 
        $_POST['LinkReunion'], $_POST['Codigo'], $_POST['LinkPresentacion'], 
        $_POST['Likes'], $_POST['Dislikes'], $_POST['Estado'], $_POST['idOrador']
    ];
    
    if ($controller->crear($data)) {
        header("Location: charlas.php");
        exit();
    } else {
        echo "Error al crear la charla.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Charla</title>
</head>
<body>
    <h2>Nueva Charla</h2>
    <form method="post">
        <label>Nombre: <input type="text" name="Nombre" required></label><br>
        <label>Institución: <input type="text" name="Institucion" required></label><br>
        <label>Departamento ID: <input type="number" name="idDepartamento" required></label><br>
        <label>Modalidad ID: <input type="number" name="idModalidad" required></label><br>
        <label>Fecha: <input type="date" name="Fecha" required></label><br>
        <label>Hora: <input type="time" name="Hora" required></label><br>
        <label>Link Reunión: <input type="text" name="LinkReunion"></label><br>
        <label>Código: <input type="text" name="Codigo"></label><br>
        <label>Link Presentación: <input type="text" name="LinkPresentacion"></label><br>
        <label>Likes: <input type="number" name="Likes" value="0"></label><br>
        <label>Dislikes: <input type="number" name="Dislikes" value="0"></label><br>
        <label>Estado: <input type="checkbox" name="Estado" value="1"></label><br>
        <label>Orador ID: <input type="number" name="idOrador" required></label><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>

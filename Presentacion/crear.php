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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>
<body>

    <?php include 'includes/navbar-abm.php'; ?>

    <h2 class="text-center my-4">Nueva Charla</h2>
        <form method="post" class="container p-4 border rounded shadow-lg bg-light" style="max-width: 850px;">
            <div class="row mb-3">
                <label for="Nombre" class="col-sm-3 col-form-label">Nombre:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="Institucion" class="col-sm-3 col-form-label">Institución:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="Institucion" name="Institucion" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="idDepartamento" class="col-sm-3 col-form-label">Departamento ID:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="idDepartamento" name="idDepartamento" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="idModalidad" class="col-sm-3 col-form-label">Modalidad ID:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="idModalidad" name="idModalidad" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="Fecha" class="col-sm-3 col-form-label">Fecha:</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="Fecha" name="Fecha" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="Hora" class="col-sm-3 col-form-label">Hora:</label>
                <div class="col-sm-9">
                    <input type="time" class="form-control" id="Hora" name="Hora" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="LinkReunion" class="col-sm-3 col-form-label">Link Reunión:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="LinkReunion" name="LinkReunion">
                </div>
            </div>

            <div class="row mb-3">
                <label for="Codigo" class="col-sm-3 col-form-label">Código:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="Codigo" name="Codigo">
                </div>
            </div>

            <div class="row mb-3">
                <label for="LinkPresentacion" class="col-sm-3 col-form-label">Link Presentación:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="LinkPresentacion" name="LinkPresentacion">
                </div>
            </div>

            <div class="row mb-3">
                <label for="Likes" class="col-sm-3 col-form-label">Likes:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="Likes" name="Likes" value="0">
                </div>
            </div>

            <div class="row mb-3">
                <label for="Dislikes" class="col-sm-3 col-form-label">Dislikes:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="Dislikes" name="Dislikes" value="0">
                </div>
            </div>

            <div class="row mb-3">
                <label for="Estado" class="col-sm-3 col-form-label">Estado:</label>
                <div class="col-sm-9">
                    <input type="checkbox" id="Estado" name="Estado" value="1">
                </div>
            </div>

            <div class="row mb-4">
                <label for="idOrador" class="col-sm-3 col-form-label">Orador ID:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="idOrador" name="idOrador" required>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

</body>
</html>

<?php
require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();

$departamentos = $controller->obtenerDepartamentos();
$modalidades = $controller->obtenerModalidades();
$oradores = $controller->obtenerOradores();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idOrador = $_POST['idOrador'];

    if (!$controller->verificarOrador($idOrador)) {
        echo "Error: El orador seleccionado no es válido.";
        exit();
    }

    //Imagen
    $imagenNombre = null;
    if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenNombre = uniqid() . '_' . basename($_FILES['Imagen']['name']);
        $imagenRuta = "../uploads/" . $imagenNombre;
        move_uploaded_file($_FILES['Imagen']['tmp_name'], $imagenRuta);
    }

    $data = [
        $_POST['Nombre'], 
        $_POST['Institucion'], 
        $_POST['idDepartamento'], 
        $_POST['idModalidad'], 
        $_POST['Fecha'], 
        $_POST['Hora'], 
        $_POST['LinkReunion'], 
        $_POST['Codigo'], 
        $_POST['LinkPresentacion'], 
        $imagenNombre,
        0,
        0,
        0,
        $idOrador
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
    <title>Añadir Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <h2 class="text-center my-4">Nueva Charla</h2>

    <form method="post" enctype="multipart/form-data" class="container p-4 border rounded shadow-lg bg-light" style="max-width: 850px;">
        <div class="row mb-3">
            <label for="Nombre" class="col-sm-3 col-form-label">Nombre del Evento:</label>
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
            <label for="idDepartamento" class="col-sm-3 col-form-label">Departamento:</label>
            <div class="col-sm-9">
                <select class="form-control" id="idDepartamento" name="idDepartamento" required>
                    <?php foreach ($departamentos as $departamento): ?>
                        <option value="<?php echo $departamento['idDepartamento']; ?>">
                            <?php echo $departamento['Departamento']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="idModalidad" class="col-sm-3 col-form-label">Modalidad:</label>
            <div class="col-sm-9">
                <select class="form-control" id="idModalidad" name="idModalidad" required>
                    <?php foreach ($modalidades as $modalidad): ?>
                        <option value="<?php echo $modalidad['idModalidad']; ?>">
                            <?php echo $modalidad['Modalidad']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
            <label for="Imagen" class="col-sm-3 col-form-label">Imagen:</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="Imagen" name="Imagen">
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
            <label for="idOrador" class="col-sm-3 col-form-label">Orador:</label>
            <div class="col-sm-9">
                <select class="form-control" id="idOrador" name="idOrador" required>
                    <?php foreach ($oradores as $orador): ?>
                        <option value="<?php echo $orador['idOrador']; ?>">
                            <?php echo $orador['Nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</body>
</html>
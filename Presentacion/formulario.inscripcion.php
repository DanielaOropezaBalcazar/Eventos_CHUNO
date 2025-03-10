<?php
session_start(); // Iniciar la sesión para usar variables de sesión
require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();

// Obtener el ID del evento a editar desde la URL
$idCharla = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idCharla) {
    // Si no hay ID, redirigir a la página de listado
    header("Location: charlas.php");
    exit();
}

// Obtener los datos del evento a editar
$charla = $controller->obtener($idCharla);

if (!$charla) {
    // Si no se encuentra el evento, redirigir a la página de listado
    header("Location: charlas.php");
    exit();
}

// Obtener las opciones para los comboboxes
$departamentos = $controller->obtenerDepartamentos();
$modalidades = $controller->obtenerModalidades();
$oradores = $controller->obtenerOradores();

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($fecha_seleccionada < $fecha_actual) {
        echo "<p style='color: red;'>Error: La fecha seleccionada no puede ser anterior a la fecha actual.</p>";
    } else {
        echo "<p style='color: green;'>Fecha válida: " . htmlspecialchars($fecha_seleccionada) . "</p>";
    }

    $uploadsDir = '../uploads/'; // Ruta de la carpeta de subidas

    // Procesar la subida de la nueva imagen
    $imagenNombre = $charla['Imagen']; // Mantener la imagen actual por defecto
    if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
        // Validar el tipo de archivo (solo imágenes)
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($_FILES['Imagen']['name'], PATHINFO_EXTENSION));

        if (in_array($extension, $extensionesPermitidas)) {
            // Generar un nombre único para la imagen
            $imagenNombre = uniqid() . '_' . basename($_FILES['Imagen']['name']);
            $imagenRuta = $uploadsDir . $imagenNombre; // Ruta completa del archivo

            // Mover el archivo subido a la carpeta de subidas
            if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $imagenRuta)) {
                // Eliminar la imagen anterior si existe
                if ($charla['Imagen'] && file_exists($uploadsDir . $charla['Imagen'])) {
                    unlink($uploadsDir . $charla['Imagen']);
                }
            } else {
                echo "Error al mover la imagen subida.";
                exit();
            }
        } else {
            echo "Formato de archivo no permitido. Solo se permiten imágenes (JPG, JPEG, PNG, GIF).";
            exit();
        }
    }

    // Verificar que el idOrador enviado exista en la tabla orador
    $idOrador = $_POST['idOrador'];
    $oradorValido = false;
    foreach ($oradores as $orador) {
        if ($orador['idOrador'] == $idOrador) {
            $oradorValido = true;
            break;
        }
    }

    if (!$oradorValido) {
        echo "Error: El orador seleccionado no es válido.";
        exit();
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
        $_POST['idOrador']
    ];

    // Intentar actualizar la charla
    if ($controller->actualizar($idCharla, $data)) {
        // Mensaje de éxito
        $_SESSION['mensaje'] = "Charla actualizada correctamente.";
        // Redirigir a la página de listado
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
    <title>Inscribir charla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <h2 class="text-center my-4">Formulario de Inscripcion</h2>
    <form method="post" enctype="multipart/form-data" class="container p-4 border rounded shadow-lg bg-light"
        style="max-width: 850px;">
        <!-- Campo para el nombre -->
        <div class="container mb-3">
            <div class="row justify-content-center"> <!-- Centra la fila -->
                <div class="col-sm-6 text-center"> <!-- Centra la columna y su contenido -->
                    <h1 for="Nombre" class="col-form-label">
                        <?php echo htmlspecialchars($charla['Nombre']); ?>
                    </h1>
                </div>
            </div>
        </div>


        <div class="row mb-3">
            <label for="Hora" class="col-sm-3 col-form-label">Hora:</label>
            <div class="col-sm-9">
            <label for="Hora" class="col-sm-3 col-form-label"><?php echo htmlspecialchars($charla['Hora']); ?></label>
                
            </div>
        </div>

        <div class="row mb-3">
            <label for="LinkReunion" class="col-sm-3 col-form-label">Link Reunión:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="LinkReunion" name="LinkReunion"
                    value="<?php echo htmlspecialchars($charla['LinkReunion']); ?>">
            </div>
        </div>

        <!-- Campo para el código -->
        <div class="row mb-3">
            <label for="Codigo" class="col-sm-3 col-form-label">Código:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="Codigo" name="Codigo"
                    value="<?php echo htmlspecialchars($charla['Codigo']); ?>">
            </div>
        </div>

        <!-- Campo para el link de presentación -->
        <div class="row mb-3">
            <label for="LinkPresentacion" class="col-sm-3 col-form-label">Link Presentación:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="LinkPresentacion" name="LinkPresentacion"
                    value="<?php echo htmlspecialchars($charla['LinkPresentacion']); ?>">
            </div>
        </div>

        <!-- Campo para la imagen actual -->
        <div class="row mb-3">
            <label for="Imagen" class="col-sm-3 col-form-label">Imagen actual:</label>
            <div class="col-sm-9">
                <?php if ($charla['Imagen']): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($charla['Imagen']); ?>" alt="Imagen de la charla"
                        style="max-width: 200px;">
                <?php else: ?>
                    <p>No hay imagen cargada.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Campo para la nueva imagen -->
        <div class="row mb-3">
            <label for="Imagen" class="col-sm-3 col-form-label">Nueva imagen:</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="Imagen" name="Imagen">
            </div>
        </div>

        <!-- Combobox para Oradores -->
        <div class="row mb-3">
            <label for="idOrador" class="col-sm-3 col-form-label">Orador:</label>
            <div class="col-sm-9">
                <select class="form-control" id="idOrador" name="idOrador" required>
                    <?php foreach ($oradores as $orador): ?>
                        <option value="<?php echo $orador['idOrador']; ?>" <?php echo ($orador['idOrador'] == $charla['idOrador']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($orador['Nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Botón de enviar -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</body>

</html>
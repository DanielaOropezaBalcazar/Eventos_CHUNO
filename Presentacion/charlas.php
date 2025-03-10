<?php
require_once "../logica_negocio/CharlaController.php"; 
$controller = new CharlaController();
$charlas = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Charlas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- Se incluye el navbar -->
    <?php include 'includes/navbar-abm.php'; ?>

    <div class="container">
        <h2 class="text-left mb-4 mt-5 ">Pagina de inicio</h2>
        <div class="row">
            <?php foreach ($charlas as $charla) { ?>
                <div class="col-12 col-sm-col-md-4 col-lg-3 mb-4">
                    <div class="card" style="border-radius: 20px">
                        <div class="ratio ratio-16x9">
                            <img src="uploads/<?= $charla['Imagen'] ?>" class="img-fluid">
                        </div>
                        <div class="card-body p-3">
                            <h4 clase="card-title p-2"><?= $charla['Nombre'] ?></h4>
                            <p><strong>Institución:</strong> <?= $charla['Institucion'] ?></p>
                            <p><strong>Fecha:</strong> <?= $charla['Fecha'] ?></p>
                            <p><strong>Hora:</strong> <?= date("H:i", strtotime($charla['Hora'])) ?></p>
                                <div class="charla-actions">
                                    <a href="editar.php?id=<?= $charla['idCharla'] ?>" class="btn btn-primary">Editar</a>
                                    <a href="eliminar.php?id=<?= $charla['idCharla'] ?>" class="btn btn-danger" 
                                    onclick="return confirm('¿Seguro que deseas eliminar esta charla?');">Eliminar</a>
                                </div> <!-- charla actions -->
                        </div> <!-- Card Body -->
                    </div>
                </div>
            <?php } ?>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
require_once "../logica_negocio/CharlaController.php";
$controller = new CharlaController();
$charlas = $controller->listar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Inscripción</title>
</head>

<body>
  <?php include 'includes/navbar-abm.php'; ?>

  <div class="container">
    <h2 class="text-left mb-4 mt-5 ">Disponibles</h2>
    <div class="row">
      <?php foreach ($charlas as $charla) { ?>
        <div class="col-12 col-sm-col-md-4 col-lg-3 mb-4">
          <div class="card" style="border-radius: 20px">
            <div class="ratio ratio-16x9">
              <img src="uploads/<?= $charla['Imagen'] ?>" class="img-fluid">
            </div>
            <div class="card-body p-3">
              <h4 clase="card-title p-2" ><?= $charla['Nombre'] ?> </h4>
              <p><strong>Institución:</strong> <?= $charla['Institucion'] ?></p>
              <p><strong>Fecha:</strong> <?= $charla['Fecha'] ?></p>
              <p><strong>Hora:</strong> <?= date("H:i", strtotime($charla['Hora'])) ?></p>
              <div class="charla-actions">
                <a href="editar.php?id=<?= $charla['idCharla'] ?>" class="btn btn-info">Inscribirme</a>

              </div> <!-- charla actions -->

            </div> <!-- Card Body -->
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- ======   VENTANA EMERGENTE      ======-->
    <!-- Este es el mensaje Modal para enviar el email -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Inscribete:<?= $charla['idCharla'] ?> </h5>
            <p id="#titulo"></p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Ingresa tu correo
                  electronico:</label>
                <input type="email" class="form-control" id="recipient-name">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Ingresa tu Nombre (Opcional):</label>
                <input type="text" class="form-control" id="message-text">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="editar.php?id=<?= $charla['idCharla'] ?>" class="btn btn-info">Inscribirme</a>
          </div>
        </div>
      </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

</body>

</html>
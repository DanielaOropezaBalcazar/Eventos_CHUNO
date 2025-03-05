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
</head>
<body>
    <h2>Charlas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Institución</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($charlas as $charla) { ?>
            <tr>
                <td><?= $charla['idCharla'] ?></td>
                <td><?= $charla['Nombre'] ?></td>
                <td><?= $charla['Institucion'] ?></td>
                <td><?= $charla['Fecha'] ?></td>
                <td><?= $charla['Hora'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $charla['idCharla'] ?>">Editar</a>
                    <a href="eliminar.php?id=<?= $charla['idCharla'] ?>" onclick="return confirm('¿Seguro que deseas eliminar esta charla?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

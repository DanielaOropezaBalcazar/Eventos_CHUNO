<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'eventos_chuno'; // verificar nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';


    if (empty($nombre) || empty($correo) || empty($password) || empty($confirm_password)) {
        echo 'Todos los campos son obligatorios.';
        exit;
    }

    // Validación de contraseñas
    if ($password !== $confirm_password) {
        echo 'Las contraseñas no coinciden.';
        exit;
    }

    // Validar que la contraseña tenga al menos 8 caracteres, al menos una mayúscula y al menos un número
    if (!preg_match('/^(?=.[A-Z])(?=.\d).{8,}$/', $password)) {
        echo 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.';
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Corregido el nombre de los campos en la tabla para que coincidan con la base de datos.
    $stmt = $conn->prepare('INSERT INTO Orador (Nombre, Gmail, Contrasena) VALUES (?, ?, ?)');

    // He añadido una calificación por defecto, por ejemplo, 0.00
    // $calificacion = 0.00;

    $stmt->bind_param('sss', $nombre, $correo, $hashed_password);

    // Redirigir a la página de inicio después de un registro exitoso
    if ($stmt->execute()) {
        header("Location: ../Presentacion/inicio.php"); // CAMBIAR a inicio.php
        exit;
    } else {
        echo 'Error al registrar el usuario: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

<?php
// Iniciar la sesión al inicio del archivo
session_start();

// Conexión a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'chuno';

$conn = new mysqli($servername, $username, $password, $database);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gmail = trim($_POST['gmail']);
    $password = trim($_POST['password']);

    if (empty($gmail) || empty($password)) {
        echo 'Por favor, ingrese ambos campos.';
        exit;
    }

    // Consulta para verificar las credenciales del usuario
    $stmt = $conn->prepare('SELECT idOrador, Contrasena FROM Orador WHERE Gmail = ?');
    $stmt->bind_param('s', $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idOrador, $hashed_password);
        $stmt->fetch();

        // Verificar si la contraseña es correcta
        if (password_verify($password, $hashed_password)) {
            echo 'Inicio de sesión exitoso!';
            // Redirigir si es necesario
            header("Location: inicio.php");
            exit;
        } else {
            echo 'Contraseña incorrecta.';
        }
    } else {
        echo 'Correo no encontrado.';
    }

    $stmt->close();
    $conn->close();
}
?>


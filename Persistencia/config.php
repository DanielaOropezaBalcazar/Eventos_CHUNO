<!-- CONEXION BASE DE DATOS -->

<?php
$host = "localhost"; // Cambia esto si usas un servidor remoto
$usuario = "admin";
$password = "admin";
$base_de_datos = "Eventos_CHUNO";

$conn = new mysqli($host, $usuario, $password, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}
?>
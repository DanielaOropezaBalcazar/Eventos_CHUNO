<?php
// enviar_correo.php
require 'mailer.php'; // Incluye la clase Mailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    // Instanciar la clase Mailer
    $mailer = new Mailer();

    // Enviar el correo
    $resultado = $mailer->enviarCorreo($destinatario, $asunto, $mensaje);

    // Redireccionar según el resultado
    if (strpos($resultado, "Error") === false) {
        echo "No funciono";
    } else {
        echo "si Funciono"; // Página de error
    }
    exit();
}
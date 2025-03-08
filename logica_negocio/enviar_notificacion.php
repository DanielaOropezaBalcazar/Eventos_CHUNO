<?php

require 'mailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    for ($i=0; $i < total ; $i++) { 
        
    }


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
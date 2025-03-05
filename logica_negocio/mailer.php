<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Carga el autoload de Composer

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true); // Habilitar excepciones

        // Configuración del servidor SMTP
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com'; // Servidor SMTP
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'eventoschuno@gmail.com'; // Tu correo
        $this->mail->Password = 'websitos123@'; // Tu contraseña
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación TLS
        $this->mail->Port = 587; // Puerto SMTP
    }

    public function enviarCorreo($destinatario, $asunto, $cuerpo) {
        try {
            // Remitente y destinatario
            $this->mail->setFrom('mauroguitarlml@gmail.com', 'Mauri');
            $this->mail->addAddress($destinatario);

            // Contenido del correo
            $this->mail->isHTML(true); // Habilitar contenido HTML
            $this->mail->Subject = $asunto;
            $this->mail->Body = $cuerpo;

            // Enviar el correo
            $this->mail->send();
            return "Correo enviado correctamente.";
        } catch (Exception $e) {
            return "Error al enviar el correo: {$this->mail->ErrorInfo}";
        }
    }
}
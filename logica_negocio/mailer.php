<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Carga el autoload de Composer

class Mailer {
    private $mail;
    private $asunto;
    private $cuerpo;

    public function __construct() {
        $this->mail = new PHPMailer(true); // Habilitar excepciones

        // Configuración del servidor SMTP
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com'; // Servidor SMTP
        $this->mail->SMTPAuth = true;
        // En caso que no funcione el correo normal, usar el de mauroguitarlml
        $this->mail->Username = 'eventoschuno@gmail.com'; // Tu correo
        $this->mail->Password = 'websitos123@'; // Tu contraseña
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación TLS
        $this->mail->Port = 587; // Puerto SMTP

        // Establecer valores predeterminados para el asunto y el cuerpo
        $this->asunto = 'Asunto predeterminado'; // Asunto predeterminado
        $this->cuerpo = 'Cuerpo del mensaje predeterminado'; // Cuerpo del mensaje predeterminado
    }

    // Método para generar el cuerpo HTML del correo con la plantilla
    public function generarCorreoHTML($nombre, $enlace) {
        $html = file_get_contents('../Presentacion/correo.template.html'); // Ruta al archivo HTML de la plantilla

        // Reemplazar los placeholders con los valores reales
        $html = str_replace('{nombre}', $nombre, $html);
        $html = str_replace('{enlace}', $enlace, $html);

        return $html;
    }

    // Función para cambiar el asunto y el cuerpo
    public function modificarMensaje($nuevoAsunto, $nuevoCuerpo) {
        $this->asunto = $nuevoAsunto;
        $this->cuerpo = $nuevoCuerpo;
    }

    // Método para enviar el correo
    public function enviarCorreo($destinatario) {
        try {
            // Remitente y destinatario
            $this->mail->setFrom('eventoschuno@gmail.com', 'Websitos');
            $this->mail->addAddress($destinatario);

            // Contenido del correo
            $this->mail->isHTML(true); // Habilitar contenido HTML
            $this->mail->Subject = $this->asunto;
            $this->mail->Body = $this->cuerpo;

            // Enviar el correo
            $this->mail->send();
            return "Correo enviado correctamente.";
        } catch (Exception $e) {
            return "Error al enviar el correo: {$this->mail->ErrorInfo}";
        }
    }
}
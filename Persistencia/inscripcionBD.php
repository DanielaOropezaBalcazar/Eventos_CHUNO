<?php

require_once "../logica_negocio/CharlaController.php";

$controller = new CharlaController();
$id = $_GET['id'] ?? null;
$charla = $id ? $controller->obtener($id) : null;


// Incluir archivo de configuración
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['correoInscripcion']) && isset($_POST['idCharla'])) {
        $correoInscripcion = $_POST['correoInscripcion'];
        $idCharla = $_POST['idCharla'];


        $destinatario = $_POST['correoInscripcion'];
        $asunto = "Reunion de Chuno Eventos";
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

        // Crear instancia de la base de datos
        $database = new Database();
        $conn = $database->getConnection();

        try {
            // Insertar en la tabla Asistente
            $queryAsistente = "INSERT INTO asistente (Gmail) VALUES ($correoInscripcion)";
            $stmtAsistente = $conn->prepare($queryAsistente);
            $stmtAsistente->bindParam(':correoInscripcion', $correoInscripcion);
            $stmtAsistente->execute();

            // Obtener el último ID insertado (idAsistente)
            $idAsistente = $conn->lastInsertId();

            // Insertar en la tabla CharlasAsistentes
            $queryCharlasAsistentes = "INSERT INTO Charlasasistentes (idAsistente, idCharla) VALUES (:idAsistente, :idCharla)";
            $stmtCharlasAsistentes = $conn->prepare($queryCharlasAsistentes);
            $stmtCharlasAsistentes->bindParam(':idAsistente', $idAsistente);
            $stmtCharlasAsistentes->bindParam(':idCharla', $idCharla);
            $stmtCharlasAsistentes->execute();

            echo "Inscripción exitosa";
        } catch (PDOException $e) {
            echo "Error al inscribir: " . $e->getMessage();
        }
    }
}
?>

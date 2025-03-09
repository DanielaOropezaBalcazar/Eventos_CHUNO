<?php
require_once __DIR__ . '/config.php';


class Opinion{
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function registrarLike($idCharla){
        $stmt = $this->conn->prepare("UPDATE Charlas SET Likes = Likes + 1 WHERE idCharla = ?");
        $stmt->bind_param("i", $idCharla);
        $stmt->execute();
    }

    public function registrarDislike($idCharla){
        $stmt = $this->conn->prepare("UPDATE Charlas SET Dislikes = Dislikes + 1 WHERE idCharla = ?");
        $stmt->bind_param("i", $idCharla);
        $stmt->execute();
    }

    public function actualizarCalificacion($idCharla){

    }

    public function actualizarCalificacion($idCharla, $valor) {
        // Obtener el ID del orador de la charla
        $stmt = $this->conn->prepare("SELECT idOrador FROM Charlas WHERE idCharla = ?");
        $stmt->bind_param("i", $idCharla);
        $stmt->execute();
        $result = $stmt->get_result();
        $charla = $result->fetch_assoc();
        
        if (!$charla) {
            return; // No se encontró la charla
        }
        
        $idOrador = $charla['idOrador'];
        
        // Obtener la calificación actual del orador
        $stmt = $this->conn->prepare("SELECT Calificacion FROM Orador WHERE idOrador = ?");
        $stmt->bind_param("i", $idOrador);
        $stmt->execute();
        $result = $stmt->get_result();
        $orador = $result->fetch_assoc();
        
        if (!$orador) {
            return; // No se encontró el orador
        }
        
        $calificacionActual = $orador['Calificacion'];
        
        // Calcular la nueva calificación
        if ($calificacionActual == 0) {
            $nuevaCalificacion = $valor;
        } else {
            $nuevaCalificacion = ($calificacionActual + $valor) / 2;
        }
        
        // Actualizar la calificación del orador
        $stmt = $this->conn->prepare("UPDATE Orador SET Calificacion = ? WHERE idOrador = ?");
        $stmt->bind_param("di", $nuevaCalificacion, $idOrador);
        $stmt->execute();
    }
}
?>
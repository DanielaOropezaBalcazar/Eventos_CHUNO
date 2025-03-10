<?php
require_once __DIR__ . '/config.php';

class InscripcionModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

// Obtiene la lista de charlas de la base de datos 
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM charlas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Encuentra la charla segun el ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Charlas WHERE idCharla = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ESTO SE CAMBIA, AQUI DEBERIA INSERTAR LOS DATOS A LA TABLA INSCRIPCIONES
    public function insert($data) {
        $query = "INSERT INTO charlas (Nombre, Institucion, idDepartamento, idModalidad, Fecha, Hora, LinkReunion, Codigo, LinkPresentacion, Imagen, Likes, Dislikes, Estado, idOrador) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query); // Usar $this->conn
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE Charlas SET Nombre=?, Institucion=?, idDepartamento=?, idModalidad=?, Fecha=?, Hora=?, LinkReunion=?, Codigo=?, LinkPresentacion=?, Imagen=?, idOrador=? WHERE idCharla=?");
        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM Charlas WHERE idCharla=?");
        return $stmt->execute([$id]);
    }

    // Obtener todos los departamentos
    public function getDepartamentos() {
        $stmt = $this->conn->prepare("SELECT idDepartamento, Departamento FROM Departamento");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas las modalidades
    public function getModalidades() {
        $stmt = $this->conn->prepare("SELECT idModalidad, Modalidad FROM Modalidad");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los oradores
    public function getOradores() {
        $stmt = $this->conn->prepare("SELECT idOrador, Nombre FROM Orador");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verificar si un orador existe
    public function verificarOrador($idOrador) {
        $query = "SELECT COUNT(*) FROM orador WHERE idOrador = :idOrador";
        $stmt = $this->conn->prepare($query); // Usar $this->conn
        $stmt->bindParam(':idOrador', $idOrador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
?>
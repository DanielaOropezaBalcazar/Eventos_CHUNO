<?php
require_once __DIR__ . '/config.php';

class CharlaModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM charlas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Charlas WHERE idCharla = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO Charlas (Nombre, Institucion, idDepartamento, idModalidad, Fecha, Hora, LinkReunion, Codigo, LinkPresentacion, Likes, Dislikes, Estado, idOrador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute(array_values($data));
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE Charlas SET Nombre=?, Institucion=?, idDepartamento=?, idModalidad=?, Fecha=?, Hora=?, LinkReunion=?, Codigo=?, LinkPresentacion=?, Likes=?, Dislikes=?, Estado=?, idOrador=? WHERE idCharla=?");
        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM Charlas WHERE idCharla=?");
        return $stmt->execute([$id]);
    }
}
?>
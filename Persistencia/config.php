<?php
class Database {
    private $host = "localhost";
<<<<<<< HEAD
    private $db_name = "eventos_chuno";
=======
    private $db_name = "chuno";
>>>>>>> 219685ee1a08071df3314224850dd4f073a3b9d0
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }

   
}




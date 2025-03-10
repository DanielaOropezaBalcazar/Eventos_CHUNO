<?php
// Verificar que el método de la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Método no permitido";
    exit;
}

include_once 'config.php';

if (isset($_POST['idOrador'])) {
    $idOrador = $_POST['idOrador'];

    function obtenerEventosFinalizados($idOrador) {
        $database = new Database();
        $conn = $database->getConnection();

        if ($conn) {
            try {
                $query = "SELECT c.idCharla, c.Nombre, c.Institucion, m.Modalidad, c.Fecha, c.Likes, c.Dislikes
                          FROM Charlas c
                          JOIN Modalidad m ON c.idModalidad = m.idModalidad
                          WHERE c.Estado = 1 AND c.idOrador = :idOrador";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':idOrador', $idOrador);
                $stmt->execute();

                $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $eventos;
            } catch (PDOException $e) {
                echo "Error al obtener eventos: " . $e->getMessage();
                return [];
            }
        } else {
            echo "Error de conexión a la base de datos.";
            return [];
        }
    }

    $eventos = obtenerEventosFinalizados($idOrador);

    foreach ($eventos as $evento) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($evento['Nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($evento['Institucion']) . "</td>";
        echo "<td>" . htmlspecialchars($evento['Modalidad']) . "</td>";
        echo "<td>" . htmlspecialchars($evento['Fecha']) . "</td>";
        echo "<td>" . htmlspecialchars($evento['Likes']) . "</td>";
        echo "<td>" . htmlspecialchars($evento['Dislikes']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "ID de orador no recibido.";
}
?>

<?php
include 'db_connection.php';

$query = $_GET['query'];

try {
    $stmt = $conn->prepare("SELECT * FROM composantes WHERE nom_composante LIKE ?");
    $stmt->execute(["%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

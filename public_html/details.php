<?php
include 'db_connection.php';

$name = $_GET['name'];

try {
    $stmt = $conn->prepare("SELECT * FROM composantes WHERE nom_composante = ?");
    $stmt->execute([$name]);
    $details = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM commentaires WHERE id_composante = ?");
    $stmt->execute([$details['id_composante']]);
    $details['commentaires'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($details);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

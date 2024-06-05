<?php
include 'db_connection.php';

try {
    // Test simple de la connexion
    $stmt = $conn->query("SELECT 1 FROM DUAL");
    echo "La connexion à la base de données est réussie.";
} catch(PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}
?>

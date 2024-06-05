<?php
// Database connection parameters
$host = 'localhost'; // Remplacez par votre hôte Oracle DB
$port = '1521'; // Port Oracle par défaut
$dbname = 'freepdb1'; // Remplacez par le nom de votre service Oracle DB ou SID
$username = 'restscott'; // Remplacez par votre nom d'utilisateur Oracle DB
$password = 'oracle'; // Remplacez par votre mot de passe Oracle DB

try {
    // Créer une nouvelle instance PDO
    $conn = new PDO("oci:dbname=$host:$port/$dbname", $username, $password);

    // Activer le mode d'affichage des erreurs pour le débogage
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Définir le mode d'erreur PDO sur exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; // Message de débogage

    // Exécuter une requête de test
    $stmt = $conn->query("SELECT 'Test' FROM DUAL");
    $result = $stmt->fetchColumn();
    echo "Test result: $result"; // Affiche la valeur récupérée
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

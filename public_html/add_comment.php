<?php
include 'db_connection.php';

$id_composante = $_POST['componentId'];
$username = $_POST['username'];
$comment_text = $_POST['commentText'];

try {
    // Récupérer l'ID de l'utilisateur (à ajuster selon votre structure de table)
    $stmt = $conn->prepare("SELECT id_utilisateur FROM utilisateurs WHERE nom_utilisateur = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $id_utilisateur = $user['id_utilisateur'];
    } else {
        // Si l'utilisateur n'existe pas, l'ajouter (ajustez selon vos besoins)
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom_utilisateur) VALUES (?)");
        $stmt->execute([$username]);
        $id_utilisateur = $conn->lastInsertId();
    }

    // Insérer le commentaire
    $stmt = $conn->prepare("INSERT INTO commentaires (id_utilisateur, id_composante, texte) VALUES (?, ?, ?)");
    $stmt->execute([$id_utilisateur, $id_composante, $comment_text]);

    echo json_encode(["success" => true]);
} catch(PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>

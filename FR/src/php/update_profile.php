<?php
header('Content-Type: application/json');
session_start();

require_once 'connectSQL.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "Utilisateur non authentifié."]);
        exit();
    }

    $pdo = getPDOConnection();
    $user_id = $_SESSION['user_id'];

    // Utilise les bons noms de champs depuis le formulaire
    $prenom = $_POST["prenom"] ?? '';
    $nom = $_POST["nom"] ?? '';
    $email = $_POST["email"] ?? '';
    $telephone = $_POST["telephone"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $ville = $_POST["ville"] ?? '';

    try {
        $stmt = $pdo->prepare("
            UPDATE user SET 
                prenom = :prenom,
                nom = :nom,
                email = :email,
                telephone = :telephone,
                adresse = :adresse,
                ville = :ville
            WHERE id_User = :user_id
        ");

        $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':user_id' => $user_id
        ]);

        // Redirection avec succès
        header('Location: Profil.php?success=1');
        exit();
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Erreur de mise à jour : " . $e->getMessage()
        ]);
    }
}
?>

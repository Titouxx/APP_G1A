<?php
header('Content-Type: application/json');
session_start();

require_once 'connectSQL.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "Utilisateur non authentifié."]);
        exit();
    }

    // Connexion à la base via la fonction centralisée
    $pdo = getPDOConnection();

    $user_id = $_SESSION['user_id'];
    $phone = $_POST["phone"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $city = $_POST["city"] ?? '';

    try {
        $stmt = $pdo->prepare("UPDATE user SET telephone = :phone, adresse = :adresse, ville = :city WHERE id_User = :user_id");
        $stmt->execute([
            ':phone' => $phone,
            ':adresse' => $adresse,
            ':city' => $city,
            ':user_id' => $user_id
        ]);

        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Erreur de mise à jour : " . $e->getMessage()
        ]);
    }
}
?>

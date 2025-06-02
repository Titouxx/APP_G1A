<?php
session_start();
header('Content-Type: application/json');

require_once 'connectSQL.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'fail', 'message' => 'Non authentifié']);
    exit();
}

$pdo = getPDOConnection();

$user_id = $_SESSION['user_id'];
$oldPassword = $_POST['oldPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';

// Vérifie que les champs sont remplis
if (empty($oldPassword) || empty($newPassword)) {
    echo json_encode(['status' => 'fail', 'message' => 'Champs requis manquants.']);
    exit();
}

try {
    // Récupération du mot de passe actuel
    $stmt = $pdo->prepare("SELECT password FROM user WHERE id_User = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'fail', 'message' => 'Utilisateur introuvable.']);
        exit();
    }

    // Vérifie le mot de passe actuel
    if (!password_verify($oldPassword, $user['password'])) {
        echo json_encode(['status' => 'fail', 'message' => 'Ancien mot de passe incorrect.']);
        exit();
    }

    // Hash le nouveau mot de passe
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Met à jour en base
    $updateStmt = $pdo->prepare("UPDATE user SET password = :newPassword WHERE id_User = :user_id");
    $updateStmt->execute([
        'newPassword' => $hashedNewPassword,
        'user_id' => $user_id
    ]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'fail', 'message' => 'Erreur : ' . $e->getMessage()]);
}

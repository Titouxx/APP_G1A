<?php
session_start();
header('Content-Type: application/json');

require_once 'connectSQL.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'fail', 'message' => 'Utilisateur non authentifié.']);
    exit();
}

$pdo = getPDOConnection();

$user_id = $_SESSION['user_id'];
$oldPassword = $_POST['oldPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

// Vérifie que tous les champs sont remplis
if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
    echo json_encode(['status' => 'fail', 'message' => 'Tous les champs sont obligatoires.']);
    exit();
}

// Vérifie que les nouveaux mots de passe correspondent
if ($newPassword !== $confirmPassword) {
    echo json_encode(['status' => 'fail', 'message' => 'Les nouveaux mots de passe ne correspondent pas.']);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT password FROM user WHERE id_User = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($oldPassword, $user['password'])) {
        echo json_encode(['status' => 'fail', 'message' => 'Ancien mot de passe incorrect.']);
        exit();
    }

    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateStmt = $pdo->prepare("UPDATE user SET password = :newPassword WHERE id_User = :user_id");
    $updateStmt->execute([
        'newPassword' => $hashedNewPassword,
        'user_id' => $user_id
    ]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'fail', 'message' => 'Erreur serveur : ' . $e->getMessage()]);
}

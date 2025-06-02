<?php
session_start();
header('Content-Type: application/json');

require_once 'connectSQL.php';
$pdo = getPDOConnection(); // Connexion centralisée

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $discussionId = $_POST['discussionId'] ?? null;
    $message = $_POST['message'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    // Validation basique
    if (!$discussionId || !$userId || empty(trim($message))) {
        echo json_encode([
            "error" => "Champs requis manquants ou invalides."
        ]);
        exit();
    }

    // Sanitize le message
    $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (discussion_id, username, message) VALUES (?, ?, ?)");
        $stmt->execute([$discussionId, $userId, $message]);

        echo json_encode([
            "username" => $userId,
            "message" => $message,
            "timestamp" => date("Y-m-d H:i:s")
        ]);
    } catch (PDOException $e) {
        error_log("Erreur d'insertion : " . $e->getMessage());
        echo json_encode([
            "error" => "Une erreur s'est produite lors de l'envoi du message."
        ]);
    }
}
?>

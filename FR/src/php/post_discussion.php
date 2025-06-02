<?php
session_start();
header('Content-Type: application/json');

require_once 'connectSQL.php';
$pdo = getPDOConnection(); // Connexion centralisée

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $topicName = $_POST['topicName'] ?? '';
    $openingMessage = $_POST['openingMessage'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if (empty($topicName) || empty($openingMessage) || !$userId) {
        $response['error'] = "Champs requis manquants ou utilisateur non connecté.";
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO discussions (topic_name, opening_message, username)
            VALUES (:topicName, :openingMessage, :username)
        ");
        $stmt->execute([
            ':topicName' => $topicName,
            ':openingMessage' => $openingMessage,
            ':username' => $userId
        ]);

        $lastInsertId = $pdo->lastInsertId();

        $response = [
            'success' => true,
            'id' => $lastInsertId,
            'topicName' => $topicName,
            'openingMessage' => $openingMessage
        ];
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
    }
}

echo json_encode($response);
?>

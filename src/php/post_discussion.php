<?php
include 'db_connect.php';
session_start();

header('Content-Type: application/json');

$response = ['success' => false]; // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $topicName = filter_var($_POST['topicName'], FILTER_SANITIZE_STRING);
    $openingMessage = filter_var($_POST['openingMessage'], FILTER_SANITIZE_STRING);
    $username = $_SESSION['username'];

    // Check if the username exists in the user table
    $userCheckStmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE id_User = ?");
    $userCheckStmt->execute([$username]);
    if ($userCheckStmt->fetchColumn() > 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO discussions (topic_name, opening_message, username) VALUES (?, ?, ?)");
            $stmt->execute([$topicName, $openingMessage, $username]);

            $lastInsertId = $pdo->lastInsertId(); // Get the last inserted ID

            // Successful operation
            $response = [
                'success' => true,
                'id' => $lastInsertId,
                'topic_name' => $topicName,
                'opening_message' => $openingMessage
            ];
        } catch (PDOException $e) {
            // Handle database errors (e.g., constraint violations)
            $response['error'] = $e->getMessage();
        }
    } else {
        $response['error'] = 'Invalid username.';
    }
}

echo json_encode($response);
?>

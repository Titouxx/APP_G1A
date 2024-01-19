<?php
include 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topicName = $_POST['topicName'];
    $openingMessage = $_POST['openingMessage'];
    $username = 'Guest'; // Since there's no session, we'll use a placeholder

    // Validate and sanitize inputs...
    // It's important to sanitize the inputs to prevent SQL injection and other security issues
    $topicName = filter_var($topicName, FILTER_SANITIZE_STRING);
    $openingMessage = filter_var($openingMessage, FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare("INSERT INTO discussions (topic_name, opening_message, username) VALUES (?, ?, ?)");
    $stmt->execute([$topicName, $openingMessage, $username]);


    // After the discussion has been inserted into the database...
    $lastInsertId = $pdo->lastInsertId(); // Get the last inserted ID
}

echo json_encode([
    'id' => $lastInsertId, // This should be the ID of the newly inserted discussion
    'topic_name' => $topicName,
    'opening_message' => $openingMessage
]);


?>

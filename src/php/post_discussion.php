<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $topicName = $_POST['topicName'];
    $openingMessage = $_POST['openingMessage'];
    $username = $_SESSION['username']; // Retrieved from session

    // Validate and sanitize inputs...

    $stmt = $pdo->prepare("INSERT INTO discussions (topic_name, opening_message, username) VALUES (?, ?, ?)");
    $stmt->execute([$topicName, $openingMessage, $username]);

    // Redirect to discussion list or the newly created discussion page
    header("Location: discussions_list.php");
    exit();
}
?>

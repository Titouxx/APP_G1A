<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discussionId = $_POST['discussionId'];
    $message = $_POST['message'];

    // Validate and sanitize inputs...
    // It's important to sanitize the inputs to prevent SQL injection and other security issues
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare("INSERT INTO messages (discussion_id, username, message) VALUES (?, ?, ?)");
    $stmt->execute([$discussionId, $username, $message]);

    header("Location: discussion.php?id=" . $discussionId);
    exit();
}
?>

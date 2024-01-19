<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $discussionId = $_POST['discussionId'];
    $message = $_POST['message'];
    $username = $_SESSION['username'];

    // Validate and sanitize inputs...

    $stmt = $pdo->prepare("INSERT INTO messages (discussion_id, username, message) VALUES (?, ?, ?)");
    $stmt->execute([$discussionId, $username, $message]);

    header("Location: discussion.php?id=" . $discussionId);
    exit();
}
?>

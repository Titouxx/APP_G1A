<?php
session_start();
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discussionId = $_POST['discussionId'];
    $message = $_POST['message'];
    $username= $_SESSION['id_User'];
    // Validate and sanitize inputs
    $message = filter_var($message, FILTER_SANITIZE_STRING);


    try {
        $stmt = $pdo->prepare("INSERT INTO messages (discussion_id, username, message) VALUES (?, ?, ?)");
        $stmt->execute([$discussionId, $username, $message]);
    } catch (PDOException $e) {
        // Handle exception
        error_log("Error in insertion: " . $e->getMessage());
        // Redirect to an error page or display an error message
    }

    header("Location: discussion.php?id=" . $discussionId);
    exit();
}
?>

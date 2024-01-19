<?php
session_start();
include 'db_connect.php';

$discussionId = $_GET['id'] ?? 0; 

// Fetching discussion details
$stmt = $pdo->prepare("SELECT * FROM discussions WHERE id = ?");
$stmt->execute([$discussionId]);
$discussion = $stmt->fetch();

echo "<h2>" . htmlspecialchars($discussion['topic_name']) . "</h2>";
echo "<p>" . htmlspecialchars($discussion['opening_message']) . "</p>";

// Fetching messages
$stmt = $pdo->prepare("SELECT username, message, timestamp FROM messages WHERE discussion_id = ? ORDER BY timestamp");
$stmt->execute([$discussionId]);
$messages = $stmt->fetchAll();

foreach ($messages as $message) {
    echo "<div>";
    echo "<p>" . htmlspecialchars($message['username']) . " (" . $message['timestamp'] . "): </p>";
    echo "<p>" . htmlspecialchars($message['message']) . "</p>";
    echo "</div>";
}

// Form to submit new message
if (isset($_SESSION['username'])) {
    echo "<form action='post_message.php' method='post'>";
    echo "<input type='hidden' name='discussionId' value='" . $discussionId . "'>";
    echo "<textarea name='message' required></textarea>";
    echo "<button type='submit'>Post Message</button>";
    echo "</form>";
}
?>


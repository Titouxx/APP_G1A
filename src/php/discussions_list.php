<?php
    include 'db_connect.php';
    session_start();

    $stmt = $pdo->query("SELECT id, topic_name, username FROM discussions");
    $discussions = $stmt->fetchAll();

    foreach ($discussions as $discussion) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($discussion['topic_name']) . "</h3>";
        echo "<p>Started by: " . htmlspecialchars($discussion['username']) . "</p>";
        echo "<a href='discussion.php?id=" . $discussion['id'] . "'>Join Discussion</a>";
        echo "</div>";
    }
?>

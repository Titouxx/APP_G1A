<?php
    session_start();
    
    // the following code allows me to check session information 
    //echo "<h3>Session Information:</h3>";
    //echo "<ul>";
    //foreach ($_SESSION as $key => $value) {
    //    echo "<li>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</li>";
    //}
    //echo "</ul>";

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

    echo "<div id='messagesContainer'>";
    foreach ($messages as $message) {
        echo "<div>";
        echo "<p>" . htmlspecialchars($message['username']) . " (" . $message['timestamp'] . "): </p>";
        echo "<p>" . htmlspecialchars($message['message']) . "</p>";
        echo "</div>";
    }
    echo "</div>";


    // Form to submit new message
    if (isset($_SESSION['user_id'])) {
        echo "<form id='messageForm'>";
        echo "<input type='hidden' name='discussionId' value='" . htmlspecialchars($discussionId) . "'>";
        echo "<textarea name='message' required></textarea>";
        echo "<button type='button' id='postMessageBtn'>Post Message</button>";
        echo "</form>";
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body>
        <script>
            document.getElementById('postMessageBtn').addEventListener('click', function() {
                var formData = new FormData(document.getElementById('messageForm'));
                
                fetch('post_message.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Expecting JSON response
                .then(data => {
                    if (data.username && data.message && data.timestamp) {
                        // Append the new message to the messages container
                        var messagesContainer = document.getElementById('messagesContainer');
                        var newMessage = "<div><p>" + data.username + " (" + data.timestamp + "): </p>" +
                                        "<p>" + data.message + "</p></div>";
                        messagesContainer.innerHTML += newMessage;

                        // Clear the message textarea
                        document.querySelector('[name="message"]').value = '';
                    } else {
                        console.error('Missing data from response:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        </script>
    </body>
</html>



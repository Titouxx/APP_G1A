<?php
    session_start();
    
    //the following code allows me to check session information 
    //echo "<h3>Session Information:</h3>";
    //echo "<ul>";
    //foreach ($_SESSION as $key => $value) {
    //    echo "<li>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</li>";
    //}
    //echo "</ul>";

    // include 'db_connect.php';
    include 'config.php';

    $discussionId = $_GET['id'] ?? 0; 

    // Fetching discussion details
    $stmt = $conn->prepare("SELECT * FROM discussions WHERE id = ?");
    $stmt->execute([$discussionId]);
    $discussion = $stmt->fetch();
   

    // Fetching messages
    $stmt = $conn->prepare("SELECT username, message, timestamp FROM messages WHERE discussion_id = ? ORDER BY timestamp");
    $stmt->execute([$discussionId]);
    $messages = $stmt->fetchAll();



    echo "<div id='messagesContainer'>";
        echo "<h2>" . htmlspecialchars($discussion['topic_name']) . "</h2>";
        echo "<p>" . htmlspecialchars($discussion['username']) . " (" . $discussion['created_at'] . "): </p>";
        echo "<p>" . htmlspecialchars($_SESSION['nom']) . " " . $_SESSION['prenom'] . ": </p>";
        echo "<p>" . htmlspecialchars($discussion['opening_message']) . "</p>";
        foreach ($messages as $message) {
            echo "<div>";
            echo "<p>" . htmlspecialchars($message['username']) . " (" . $message['timestamp'] . "): </p>";
            echo "<p>" . htmlspecialchars($_SESSION['nom']) . " " . $_SESSION['prenom'] . ": </p>";
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
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <title>TransNoise - EchoKey</title>
        <link rel="stylesheet" href="../css/discussion.css"/>
        <link rel="stylesheet" href="../css/normalize.css" />
        <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
        <script src="../js/jquery.min.js"></script>
    </head>
    <body background="../../images/bgtest2.png">
        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="analyse.php">Analyse</a></li>
                <li><a href="faq.php">Faq</a></li>
                <li><a href="espaceuser.php">Profil</a></li>
            </ul>
        </nav>
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



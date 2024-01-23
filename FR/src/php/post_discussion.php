<?php
    include 'db_connect.php';
    session_start();

    header('Content-Type: application/json');

    $response = ['success' => false]; // Default response

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $topicName = $_POST['topicName'];
        $openingMessage = $_POST['openingMessage'];
        $username = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        try {
            // Using prepared statements with placeholders
            $stmt = $pdo->prepare("INSERT INTO discussions (topic_name, opening_message, username) VALUES (:topicName, :openingMessage, :username)");
            // Binding parameters
            $stmt->execute([
                ':topicName' => $topicName,
                ':openingMessage' => $openingMessage,
                ':username' => $username
            ]);

            $lastInsertId = $pdo->lastInsertId(); // Get the last inserted ID

            // Successful operation
            $response = [
                'success' => true,
                'id' => $lastInsertId,
                'topicName' => $topicName,
                'openingMessage' => $openingMessage
            ];
        } catch (PDOException $e) {
            // Handle database errors (e.g., constraint violations)
            $response['error'] = $e->getMessage();
        }

        echo json_encode($response);
    }
?>

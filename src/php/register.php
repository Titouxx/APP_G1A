<?php
session_start(); // Démarre la session au début du script

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "siteweb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];
        $repeatPassword = $_POST['RepeatPassword'];

        if ($password !== $repeatPassword) {
            echo json_encode(["status" => "error", "message" => "Les mots de passe ne correspondent pas."]);
            exit;
        }

        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(['email' => $email]);

        if ($checkEmail->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "email_exists"]);
            exit;
        }

        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $password]);

        // Stocker les informations de l'utilisateur dans la session après l'inscription
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;

        echo json_encode(["status" => "success"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
}

$conn = null;
?>

<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siteweb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
 
        // Création de la requête SQL
        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $hashedPassword]);

        echo json_encode(["status" => "success"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
}

$conn = null;
?>

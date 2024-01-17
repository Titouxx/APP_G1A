<?php
session_start(); // Démarre la session au début du script

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$passwordDB = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=siteweb", $username, $passwordDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        $sql = "SELECT id_User, password FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id_User'];
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;

            echo json_encode(["status" => "success"]);
            exit();
        } else {
            echo json_encode(["status" => "error", "message" => "Identifiants invalides"]);
            exit();
        }
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    exit();
}

$conn = null;
?>

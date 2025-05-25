<?php
include 'config.php';
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Ajout du champ `statut` dans le SELECT
        $sql = "SELECT id_User, prenom, nom, password, statut FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_User'];
            $_SESSION['email'] = $email;
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['statut'] = $user['statut'];
            $_SESSION['logged_in'] = true;

            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Identifiants invalides"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

$conn = null;
?>

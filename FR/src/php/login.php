<?php
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'connectSQL.php';
$pdo = getPDOConnection(); // Utilisation centralisée de PDO

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['loginEmail'] ?? '';
        $password = $_POST['loginPassword'] ?? '';

        if (empty($email) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Champs requis manquants."]);
            exit;
        }

        $sql = "SELECT id_User, prenom, nom, password FROM user WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

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
    } else {
        echo json_encode(["status" => "error", "message" => "Requête non autorisée"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
<?php
require_once 'connectSQL.php';
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = getPDOConnection();

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom          = trim($_POST['registerFirstName'] ?? '');
        $nom             = trim($_POST['registerLastName'] ?? '');
        $email           = trim($_POST['registerEmail'] ?? '');
        $password        = $_POST['registerPassword'] ?? '';
        $repeatPassword  = $_POST['RepeatPassword'] ?? '';

        // Champs requis
        if (empty($prenom) || empty($nom) || empty($email) || empty($password) || empty($repeatPassword)) {
            echo json_encode(["status" => "error", "message" => "Tous les champs sont requis."]);
            exit;
        }

        // Validation du mot de passe
        if ($password !== $repeatPassword) {
            echo json_encode(["status" => "error", "message" => "Les mots de passe ne correspondent pas."]);
            exit;
        }

        if (strlen($password) < 10) {
            echo json_encode(["status" => "error", "message" => "Le mot de passe doit contenir au moins 10 caractères."]);
            exit;
        }

        if (!preg_match('/[0-9]/', $password)) {
            echo json_encode(["status" => "error", "message" => "Le mot de passe doit contenir au moins un chiffre."]);
            exit;
        }

        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            echo json_encode(["status" => "error", "message" => "Le mot de passe doit contenir au moins un caractère spécial."]);
            exit;
        }

        // Email valide ?
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Format d'e-mail invalide."]);
            exit;
        }

        // Email déjà utilisé ?
        $stmt = $pdo->prepare("SELECT 1 FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            echo json_encode(["status" => "error", "message" => "email_exists"]);
            exit;
        }

        // Hash du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertion
        $stmt = $pdo->prepare("INSERT INTO user (prenom, nom, email, password) VALUES (:prenom, :nom, :email, :password)");
        $stmt->execute([
            'prenom'   => $prenom,
            'nom'      => $nom,
            'email'    => $email,
            'password' => $hashed_password
        ]);

        // Démarrage session
        $_SESSION['user_id']   = $pdo->lastInsertId();
        $_SESSION['prenom']    = $prenom;
        $_SESSION['nom']       = $nom;
        $_SESSION['email']     = $email;
        $_SESSION['logged_in'] = true;

        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur PDO : " . $e->getMessage()]);
}
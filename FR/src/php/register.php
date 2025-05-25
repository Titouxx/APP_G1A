<?php
include 'config.php';
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = $_POST['registerFirstName'];
        $nom = $_POST['registerLastName'];
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];
        $repeatPassword = $_POST['RepeatPassword'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 'etudiant'; // Valeur par défaut

        // Vérification si les mots de passe correspondent
        if ($password !== $repeatPassword) {
            echo json_encode(["status" => "error", "message" => "Les mots de passe ne correspondent pas."]);
            exit;
        }

        if (strlen($password) < 10) {
            echo json_encode(["status" => "error", "message" => "Le mot de passe doit contenir plus de 10 caractères."]);
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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Format d'email invalide."]);
            exit;
        }

        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(['email' => $email]);
        if ($checkEmail->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "email_exists"]);
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (prenom, nom, email, password, statut) 
                VALUES (:prenom, :nom, :email, :hashed_password, :statut)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'hashed_password' => $hashed_password,
            'statut' => $statut
        ]);

        // Stockage en session
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['statut'] = $statut;
        $_SESSION['logged_in'] = true;

        echo json_encode(["status" => "success"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
    exit;
}

$conn = null;
?>

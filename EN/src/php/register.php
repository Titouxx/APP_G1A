<?php
include 'config.php';
session_start();

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// $servername = "localhost";
// $username = "root";
// $passwordDB = "";
// $dbname = "siteweb";

try {
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $passwordDB);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = $_POST['registerFirstName'];
        $nom = $_POST['registerLastName'];
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];
        $repeatPassword = $_POST['RepeatPassword'];

        // Vérification si le mot de passe est correct
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

        // Vérification si l'email existe déjà
        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(['email' => $email]);
        if ($checkEmail->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "email_exists"]);
            exit; 
        }

        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertion des données dans la base de données
        $sql = "INSERT INTO user (prenom, nom, email, password) VALUES (:prenom, :nom, :email, :hashed_password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['prenom' => $prenom, 'nom' => $nom, 'email' => $email, 'hashed_password' => $hashed_password]);

        // Stockage des informations dans la session
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;

        // Réponse en cas de succès
        echo json_encode(["status" => "success"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
    exit; 
}

$conn = null;
?>

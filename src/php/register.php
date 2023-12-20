<?php
include 'dataBase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $repeatPassword = $_POST['RepeatPassword'];

    if ($password !== $repeatPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(['email' => $email, 'password' => $hashed_password]);
        echo "Utilisateur enregistré avec succès";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "L'adresse email est déjà utilisée.";
        } else {
            echo "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

$conn = null;
?>

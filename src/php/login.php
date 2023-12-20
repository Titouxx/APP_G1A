<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['loginEmail']);
    $password = $conn->real_escape_string($_POST['loginPassword']);

    $sql = "SELECT id, password FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Connexion réussie";
            // Configurez ici les variables de session
        } else {
            echo "Mot de passe invalide";
        }
    } else {
        echo "Email invalide";
    }
}

$conn->close();
?>

<?php
// include 'dataBase.php';

 
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername; dbname=siteweb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion Réussie !";
}
catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $repeatPassword = $_POST['RepeatPassword'];

    if ($password !== $repeatPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(['email' => $email, 'password' => $password]);
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

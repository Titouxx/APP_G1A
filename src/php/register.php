<?php
header('Content-Type: application/json');

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siteweb";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO à Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];
        $repeatPassword = $_POST['RepeatPassword'];

        // Vérifier si les mots de passe correspondent
        if ($password !== $repeatPassword) {
            echo json_encode(["status" => "error", "message" => "Les mots de passe ne correspondent pas."]);
            exit;
        }
        // Vérifier si l'email existe déjà
        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(['email' => $email]);
        if ($checkEmail->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "email_exists"]);
            exit;
        }

        // Création de la requête SQL
        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);

        // Exécution de la requête
        $stmt->execute(['email' => $email, 'password' => $password]);

        // Réponse de succès
        echo json_encode(["status" => "success"]);
    }
} catch(PDOException $e) {
    // Gestion des erreurs
    echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
}

// Fermeture de la connexion
$conn = null;
?>

<?php
// include 'dataBase.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

 
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername;dbname=siteweb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion Réussie !";
}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT password FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // var_dump($user); // Pour voir le résultat de la requête


    // if ($user && password_verify($password, $user['password'])) {
    //     echo "success";
    //     // Configurez ici les variables de session
    // } else {
    //      echo "Identifiants invalides";
    //     // echo "Mot de passe de la base de données : " . $user['password'];
    //     // echo "\nMot de passe fourni haché : " . password_hash($password, PASSWORD_DEFAULT);
    //     // echo "\nIdentifiants invalides";
    // }
    if ($user && $password === $user['password']) {
        // echo "success";
        // Configurez ici les variables de session
        echo json_encode(["statue" => "success"]);

    } else {
        // echo "Identifiants invalides";
        echo json_encode(["status" => "error", "message" => "Identifiants invalides"]);
    }

}

$conn = null;
?> 
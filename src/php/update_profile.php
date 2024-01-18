<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "siteweb";
    
    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
        exit;
    }
    
    // Récupération et échappement des données POST pour éviter les injections SQL
    $first_name = $conn->real_escape_string($_POST["first_name"]);
    $last_name = $conn->real_escape_string($_POST["last_name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $adresse = $conn->real_escape_string($_POST["adresse"]);
    $city = $conn->real_escape_string($_POST["city"]);
    
    // Mise à jour des informations dans la base de données
    $sql = "UPDATE user SET prenom = '$first_name', nom = '$last_name', email = '$email', telephone = '$phone', adresse = '$adresse', ville = '$city' WHERE id_User = 1";
    
    if ($conn->query($sql) !== FALSE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating record: " . $conn->error]);
    }
    
    $conn->close();
}
?>
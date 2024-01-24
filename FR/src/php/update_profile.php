<?php
header('Content-Type: application/json');
session_start();
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
    $phone = $conn->real_escape_string($_POST["phone"]);
    $adresse = $conn->real_escape_string($_POST["adresse"]);
    $city = $conn->real_escape_string($_POST["city"]);
    
    // Mise à jour des informations dans la base de données
    $session_id = session_id();
    $id_User = $_SESSION['id_User']; // Get the user ID from the session

    
    $sql = "UPDATE user SET  telephone = '$phone', adresse = '$adresse', ville = '$city' WHERE id_User = '$id_User'";
    
    if ($conn->query($sql) !== FALSE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating record: " . $conn->error]);
    }
    
    $conn->close();
}

?>
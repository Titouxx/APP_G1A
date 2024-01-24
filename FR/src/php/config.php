<?php
// $servername = "localhost";
// $username = "root";
// $passwordDB = "";
// $dbname = "siteweb";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $passwordDB);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo json_encode(["status" => "error", "message" => "Erreur lors de la connexion à la base de données : " . $e->getMessage()]);
//     exit;
// }

$host = 'localhost';
$db   = 'siteweb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
    exit;
}
?>

 <?php
 
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername; dbname;siteweb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion Réussie !";
}
catch(PDOExeption $e){
    echo "Erreur : ".$e->getMessage();
}

?>


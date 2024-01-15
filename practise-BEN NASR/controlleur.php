<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "devinettes";

$conn = new mysqli($servername, $username, $password, $dbname);

/** recupere la valeur de la devinette */
$selectedDevinette = $_POST["devinette"];

$sql = "SELECT titre, texte, solution FROM devinette WHERE id_devinette = $selectedDevinette";

$stmt = $conn->prepare($sql);   

$stmt->execute();
$stmt->bind_result($titre, $texte, $solution);

// Affichage de la devinette
if ($stmt->fetch()) {
    $_SESSION['texte'] = $texte;
    $_SESSION['titre'] = $titre;
    $_SESSION['solution'] = $solution;
header("Location: devinette.php");
//session_destroy();
    exit();
    /*echo "<p>$titre : $texte</p>";
    echo "<p>Solution : $solution</p>";*/
}

//$conn->close();

?>
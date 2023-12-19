<?php
$servername = "localhost"; // Nom du serveur MySQL (généralement "localhost")
$username = "votre_nom_utilisateur"; // Votre nom d'utilisateur MySQL
$password = "votre_mot_de_passe"; // Votre mot de passe MySQL
$database = "votre_base_de_donnees"; // Le nom de votre base de données

// Établir la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

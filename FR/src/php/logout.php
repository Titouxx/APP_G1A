<?php
session_start(); // Démarrer la session pour accéder aux variables de session

// Vider les variables de session
$_SESSION = array();

// Supprimer le cookie de session si celui-ci existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: index.php"); //redirection 
exit();
?>

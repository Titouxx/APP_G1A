<?php
// Récupérer la valeur de la recherche (dans cet exemple, elle est envoyée en tant que 'query')
if(isset($_POST['query'])) {
    $query = $_POST['query'];

    // Connexion à la base de données
    // Remplacer les paramètres suivants par vos propres informations de connexion
    $serveur = "localhost";
    $utilisateur = "siteweb";
    $motdepasse = "";
    $basededonnees = "siteweb";

    $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    // Requête SQL pour récupérer l'e-mail de l'utilisateur en fonction de la recherche
    $sql = "SELECT email FROM user WHERE email = '$query'"; // Utilisez la colonne correcte de votre base de données

    $resultat = $connexion->query($sql);

    if ($resultat->num_rows > 0) {
        // Récupérer l'e-mail de l'utilisateur
        while($row = $resultat->fetch_assoc()) {
            $email_utilisateur = $row['email'];

            // Envoi de l'e-mail à l'utilisateur
            $to = $email_utilisateur;
            $subject = "Sujet de l'e-mail";
            $message = "Contenu de l'e-mail pour l'utilisateur";
            $headers = "thegamer0092130@gmail.com"; // Remplacez par votre adresse e-mail

            // Envoyer l'e-mail
            mail($to, $subject, $message, $headers);
            
            // Message de réussite avec indicateur de connexion
            echo "E-mail envoyé à l'utilisateur : ".$to."\n";
            echo "Statut de connexion : connected";
        }
    } else {
        // Aucun utilisateur trouvé pour cette recherche
        echo "Aucun utilisateur trouvé pour cette recherche.\n";
        echo "Statut de connexion : connected"; // Vous pouvez ajuster ce message en fonction de votre logique
    }

    // Fermer la connexion à la base de données
    $connexion->close();
} else {
    // Aucune donnée de recherche reçue
    echo "Aucune donnée de recherche reçue.\n";
    echo "Statut de connexion : connected"; // Vous pouvez ajuster ce message en fonction de votre logique
}
?>

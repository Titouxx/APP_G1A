<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\APP_G1A\src\php\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\APP_G1A\src\php\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\APP_G1A\src\php\PHPMailer-master\src\SMTP.php';

// Récupérer la valeur de la recherche (dans cet exemple, elle est envoyée en tant que 'query')
if(isset($_POST['query'])) {
    $query = $_POST['query'];

    // Connexion à la base de données
    // Remplacer les paramètres suivants par vos propres informations de connexion
    $serveur = "localhost";
    $utilisateur = "siteweb";
    $motdepasse = '';
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
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'transnoiseechokey@gmail.com';
                $mail->Password   = 'azertyui1234*';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                // Autres configurations
                $mail->setFrom('transnoiseechokey@gmail.com', 'TransNoise - Echokey');
                $mail->addAddress($email_utilisateur);
                $mail->isHTML(true);
                $mail->Subject = 'Sujet du message';
                $mail->Body    = 'Contenu du message';

                // Niveau de débogage
                $mail->SMTPDebug = 2;

                // Envoyer l'e-mail
                $mail->send();
                
                // Message de réussite avec indicateur de connexion
                echo "E-mail envoyé à l'utilisateur : ".$email_utilisateur."\n";
                echo "Statut de connexion : connected";
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
            }
        }
    } else {
        // Aucun utilisateur trouvé pour cette recherche
        echo "Aucun utilisateur trouvé pour cette recherche.\n";
        echo "Statut de connexion : connected";
    }

    // Fermer la connexion à la base de données
    $connexion->close();
} else {
    // Aucune donnée de recherche reçue
    echo "Aucune donnée de recherche reçue.\n";
    echo "Statut de connexion : connected";
}
?>

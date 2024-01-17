<?php
// Démarrez la session au début de chaque page PHP
session_start();

// Vérifiez la dernière activité et déconnectez l'utilisateur après 1 heure d'inactivité
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Déconnecter l'utilisateur après 1 heure d'inactivité
    session_unset();
    session_destroy();
}
$_SESSION['last_activity'] = time();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Récupérer la valeur de la recherche (dans cet exemple, elle est envoyée en tant que 'query')
if (isset($_POST['searchQueryInput']) && !empty($_POST['searchQueryInput'])) {
    // Récupérer la valeur du champ de recherche
    $query = $_POST['searchQueryInput'];

    // Connexion à la base de données
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
    $stmt = $connexion->prepare("SELECT email, prenom, nom FROM user WHERE email = ?");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $resultat = $stmt->get_result();

    if ($resultat->num_rows > 0) {
        // Récupérer l'e-mail de l'utilisateur
        while($row = $resultat->fetch_assoc()) {
            $email_utilisateur = $row['email'];
            $prenom_utilisateur = $row['prenom']; // Ajoutez cette ligne
            $nom_utilisateur = $row['nom']; // Ajoutez cette ligne

            // Envoi de l'e-mail à l'utilisateur
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'transnoiseechokey@gmail.com';
                $mail->Password   = 'omah cbun dcto zesr ';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                echo "Bien connecté";

                // Autres configurations
                $mail->setFrom('transnoiseechokey@gmail.com', 'TransNoise - Echokey');
                $mail->addAddress($email_utilisateur);
                $mail->isHTML(true);
                $mail->Subject = 'Contact - Question TransNoise';
                $mail->Body    = 'Bonjour '.$prenom_utilisateur.' '.$nom_utilisateur.' ! Merci de visiter notre site.';

                // Niveau de débogage
                $mail->SMTPDebug = 3;

                // Envoyer l'e-mail
                $mail->send();
                
                // Message de réussite avec indicateur de connexion
                $response = array(
                    'status' => 'success',
                    'message' => 'E-mail envoyé à l\'utilisateur : ' . $email_utilisateur,
                    'welcomeMessage' => 'Bonjour ' . $prenom_utilisateur . ' ' . $nom_utilisateur . ' !'
                );
                echo json_encode($response);
                
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";

            }
        }
    } else {
        // Aucun utilisateur trouvé pour cette recherche
        echo "Aucune donnée de recherche reçue ou la recherche est vide.\n";
        echo "Valeur de la requête : " . $query;
        echo "\nErreur SQL : " . $stmt->error;
        echo "\nStatut de connexion : connected";
    }

    // Fermer la connexion à la base de données
    $connexion->close();
} else {
    // Aucune donnée de recherche reçue
    echo "Aucune donnée de recherche reçue.\n";
    echo "Statut de connexion : connected \n";
    var_dump($_POST);
}

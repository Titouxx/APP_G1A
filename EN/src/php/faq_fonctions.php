<?php
include 'config.php';
// Démarrez la session au début de chaque page PHP

session_start();

// Assurez-vous que l'utilisateur est connecté avant de procéder
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: Connexion.php");
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Récupérer la valeur de la recherche (dans cet exemple, elle est envoyée en tant que 'query')
if (isset($_POST['searchQueryInput']) && !empty($_POST['searchQueryInput'])) {
    // Récupérer l'adresse e-mail de l'utilisateur actuellement connecté
    $userEmail = $_SESSION['email'];

    // // Connexion à la base de données
    // $serveur = "localhost";
    // $utilisateur = "root";
    // $motdepasse = '';
    // $basededonnees = "siteweb";

    // $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

    // // Vérifier la connexion
    // if ($connexion->connect_error) {
    //     die("La connexion a échoué : " . $connexion->connect_error);
    // }
    try{
        // Requête SQL pour récupérer le nom et le prénom de l'utilisateur
        $stmtInfo = $conn->prepare("SELECT prenom, nom FROM user WHERE email = :userEmail");
        $stmtInfo->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $stmtInfo->execute();
        $resultatInfo = $stmtInfo->fetch(PDO::FETCH_ASSOC);        

        // if ($resultatInfo->num_rows > 0) {
        //     while ($rowInfo = $resultatInfo->fetch_assoc()) {
        //         $prenom_utilisateur = $rowInfo['prenom'];
        //         $nom_utilisateur = $rowInfo['nom'];
        //     }
        if ($resultatInfo) {
            $prenom_utilisateur = $resultatInfo['prenom'];
            $nom_utilisateur = $resultatInfo['nom'];

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

                // Autres configurations
                $mail->setFrom('transnoiseechokey@gmail.com', 'TransNoise - Echokey');
                $mail->addAddress('transnoiseechokey@gmail.com');
                $mail->isHTML(true);
                $mail->Subject = 'Contact - Question TransNoise';
                $mail->Body = 'Adresse e-mail : ' . $userEmail . '<br>' .
                            'Nom : ' . $nom_utilisateur . '<br>' .
                            'Prénom : ' . $prenom_utilisateur . '<br>' .
                            'Question : ' . $_POST['searchQueryInput'];

                // Niveau de débogage
                $mail->SMTPDebug = 3;

                // Envoyer l'e-mail
                $mail->send();
                
                // Message de réussite avec indicateur de connexion
                $response = array(
                    'status' => 'success',
                    'message' => 'E-mail envoyé à l\'utilisateur : ' . $userEmail,
                    'welcomeMessage' => 'Bonjour ' . $prenom_utilisateur . ' ' . $nom_utilisateur . ' !'
                );
                echo json_encode($response);

                } catch (Exception $e) {
                    echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
                }
                
        } else {
            // Aucune information utilisateur trouvée
            echo "Aucune information utilisateur trouvée.\n";
        }
    } catch (\PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
        exit;
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Aucune donnée de recherche reçue
    echo "Aucune donnée de recherche reçue.\n";
    echo "Statut de connexion : connected \n";
    var_dump($_POST);
}


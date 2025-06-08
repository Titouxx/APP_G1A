<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection(); // 💡 Utilisation correcte

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['searchQueryInput']) && !empty($_POST['searchQueryInput'])) {
    $userEmail = $_SESSION['email'];

    try {
        $stmtInfo = $pdo->prepare("SELECT prenom, nom FROM user WHERE email = :userEmail");
        $stmtInfo->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $stmtInfo->execute();
        $resultatInfo = $stmtInfo->fetch();

        if ($resultatInfo) {
            $prenom_utilisateur = $resultatInfo['prenom'];
            $nom_utilisateur = $resultatInfo['nom'];

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'transnoiseechokey@gmail.com';
                $mail->Password   = 'omah cbun dcto zesr'; // ⚠️ Ne jamais exposer en production
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('transnoiseechokey@gmail.com', 'TransNoise - Echokey');
                $mail->addAddress('transnoiseechokey@gmail.com');
                $mail->isHTML(true);
                $mail->Subject = 'Contact - Question TransNoise';
                $mail->Body = 'Adresse e-mail : ' . htmlspecialchars($userEmail) . '<br>' .
                    'Nom : ' . htmlspecialchars($nom_utilisateur) . '<br>' .
                    'Prénom : ' . htmlspecialchars($prenom_utilisateur) . '<br>' .
                    'Question : ' . nl2br(htmlspecialchars($_POST['searchQueryInput']));

                $mail->SMTPDebug = 0;
                $mail->send();

                echo json_encode([
                    'status' => 'success',
                    'message' => 'E-mail envoyé à l\'utilisateur : ' . $userEmail,
                    'welcomeMessage' => 'Bonjour ' . $prenom_utilisateur . ' ' . $nom_utilisateur . ' !'
                ]);

            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Erreur mail : {$mail->ErrorInfo}"]);
            }

        } else {
            echo json_encode(["status" => "error", "message" => "Aucun utilisateur trouvé."]);
        }

    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Erreur SQL : " . $e->getMessage()]);
        exit;
    }

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Aucune question reçue.",
        "debug" => $_POST
    ]);
}
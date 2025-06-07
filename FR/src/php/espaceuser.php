<?php
session_start();
$pageCSS = '../css/espaceuser.css';
include '../include/header.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}
?>



<!-- Titre de l'espace utilisateur -->
<div class="welcome-section">
    <h1>Bienvenue dans votre espace !</h1>
</div>

<!-- Section principale avec les deux liens -->
<div class="main">
    <div class="img1">
        <figure>
            <a href="profil.php">
                <img src="../../images/profil.png" id="img-profil" />
                <div class="image-text">Profil</div>
            </a>
        </figure>
    </div>

    <div class="img2">
        <figure>
            <a href="commande.php">
                <img src="../../images/commandebutton.png" id="img-analyse" />
                <div class="image-text2">Analyse</div>
            </a>
        </figure>
    </div>
</div>

<?php include '../include/footer.php'; ?>
<script src="../js/espaceuser.js"></script>
<?php
$pageCSS = 'css/index.css';
include 'include/header_index.php';
?>


<?php
if (isset($_SESSION['user_id'])) {
    echo '<p class="welcome-message">Bienvenue ' . htmlspecialchars($_SESSION['prenom']) . ' !</p>';
}
?>

<!-- Contenu principal -->
<div class="content">
    <h1>Nutritium</h1>
    <img src="../images/homepic.jpg" alt="image d’accueil" height="300px" />
</div>

<div class="content-container">
    <div class="left">
        <h1 class="Nutritium">Apporter une solution durable <br /> à la précarité étudiante</h1>
        <p class="paragraphe">
            <br /> Chaque année, les files d’étudiants devant les banques alimentaires s’allongent. Ces scènes sont
            d’autant plus marquantes lorsque des mesures comme les repas à 1 € pour tous au CROUS sont rejetées.
        </p>
        <br />
        <p class="paragraphe">
            C’est avec ambition et détermination que nous portons le projet de Nutritium, une structure conçue pour
            aider un maximum de personnes à se nourrir dignement à un coût minimal, tout en répondant de manière durable
            à une problématique sociale urgente.
        </p>
        <br />
        <p class="paragraphe">
            Géographiquement basés à l’incubateur ISEP d’Issy-Les-Moulineaux, notre démarche commencera à Paris et sa
            banlieue, avec l'ambition de nous étendre progressivement à l'échelle nationale d’ici 3 ans.
        </p>
    </div>
</div>

<div class="buton">
    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<button class="cn" id="scrollButton"><a href="php/logout.php">Souhaitez-vous vous déconnecter</a></button>';
    } else {
        echo '<button class="cn" id="scrollButton"><a href="php/Connexion.php">Connectez-vous !</a></button>';
    }
    ?>
</div>

<?php include 'include/footer_index.php'; ?>
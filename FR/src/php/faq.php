<?php
$pageCSS = '../css/faq.css';
include '../include/header.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}
?>

<div class="container">
    <h2 class="faq-title">Posez votre question :</h2>

    <!-- Barre de recherche -->
    <div class="wrapper">
        <div class="searchBar">
            <form id="searchForm">
                <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Posez votre question ici">
                <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                    <img class="arrow-icon" id="hoverImage" src="../../images/arrow.png" width="30" height="30" />
                </button>
            </form>
        </div>
    </div>

    <h4 class="faq-subtitle">Ou consultez les questions suivantes :</h4>

    <div class="accordion">
        <!-- FAQ Items -->
        <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
                <span class="accordion-title">Comment fonctionne la commande de panier ?</span><span class="icon"
                    aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
                <p>Une fois votre compte créé, vous pouvez réserver un panier depuis <a href="commande.php">Commander un
                        panier</a>. Un QR code vous sera alors généré.</p>
            </div>
        </div>

        <div class="accordion-item">
            <button id="accordion-button-2" aria-expanded="false">
                <span class="accordion-title">De quoi est composé le panier ?</span><span class="icon"
                    aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
                <p>Nos paniers sont conçus avec l’aide de nutritionnistes et adaptés à divers régimes (basique, végé,
                    halal...).</p>
            </div>
        </div>

        <div class="accordion-item">
            <button id="accordion-button-3" aria-expanded="false">
                <span class="accordion-title">Quel est la plus-value de Nutritium™ ?</span><span class="icon"
                    aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
                <p>Nutritium™ propose des paniers frais, complets et équilibrés à prix réduits pour les étudiants
                    précaires.</p>
            </div>
        </div>

        <div class="accordion-item">
            <button id="accordion-button-4" aria-expanded="false">
                <span class="accordion-title">Qui peut utiliser Nutritium™ ?</span><span class="icon"
                    aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
                <p>Le service est destiné en priorité aux étudiants. Les non-étudiants peuvent aussi commander (50€ au
                    lieu de 40€).</p>
            </div>
        </div>

        <div class="accordion-item">
            <button id="accordion-button-5" aria-expanded="false">
                <span class="accordion-title">Autre question ?</span><span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
                <p>Utilisez la barre de recherche ci-dessus pour poser votre question. Un membre de notre équipe vous
                    répondra par email.</p>
            </div>
        </div>
    </div>
</div>

<script src="../js/faq.js"></script>
<?php include '../include/footer.php'; ?>
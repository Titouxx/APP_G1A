<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/commande.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <script src="../js/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../images/logonutritium.ico" />
    <title>Akatsuki - Nutritium</title>

    <!-- Leaflet pour carte -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="commande.php">Commander un panier</a></li>
                <li><a href="espaceuser.php">Profil</a></li>
            </ul>
        </nav>
    </header>

    <a href="index.php">
        <img src="../../images/logonutritium.png" id="Logo1" alt="Logo EchoKey" title="Logo EchoKey">
    </a>

    <h1>Nos partenaires les plus proches</h1>

    <div class="partenaires-container">
        <div id="mapid"></div>

        <div class="partenaires-liste">
            <h2>Nos partenaires</h2>

            <div class="partenaire">
                <strong>Marché Bio Paris</strong><br>
                12 Rue de Rivoli, 75001 Paris<br>
                Produits bio & locaux
            </div>

            <div class="partenaire">
                <strong>Épicerie Verte</strong><br>
                8 Boulevard Voltaire, 75011 Paris<br>
                Produits zéro déchet
            </div>

            <div class="partenaire">
                <strong>Fruits&Co</strong><br>
                25 Rue Saint-Honoré, 75008 Paris<br>
                Fruits frais toute l'année
            </div>
        </div>
    </div>


    <img src="../../images/footernutritium.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter">
    <img src="../../images/déconnexion2.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">

    <footer>
        <div class="footer">
            <nav>
                <ul>
                    <li><a href="CGU.php" id="ga" target="_blank">C.G.U</a></li>
                    <li><a href="https://www.isep.fr/" id="ga" target="_blank">Nos investisseurs</a></li>
                    <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
                </ul>
            </nav>
        </div>
    </footer>

    <script src="../js/commande.js"></script>

    <script>
        // Initialisation de la carte
        var map = L.map('mapid').setView([48.8566, 2.3522], 12); // Centre Paris

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Ajout des marqueurs (à adapter selon les partenaires réels)
        const partenaires = [
            { nom: "Marché Bio Paris", lat: 48.8606, lon: 2.3376 },
            { nom: "Épicerie Verte", lat: 48.8500, lon: 2.3600 },
            { nom: "Fruits&Co", lat: 48.8700, lon: 2.3000 }
        ];

        partenaires.forEach(p => {
            L.marker([p.lat, p.lon]).addTo(map).bindPopup(p.nom);
        });
    </script>
</body>
</html>

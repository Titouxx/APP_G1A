<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection(); // ✅ utilisation correcte

try {
    $stmt = $pdo->query("SELECT * FROM partenaires");
    $partenaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/commande.css" />
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

<div class="partenaires-container-row">
    <div class="partenaires-liste">
        <h2>Nos partenaires</h2>

        <?php foreach ($partenaires as $p): ?>
            <div class="partenaire">
                <strong><?= htmlspecialchars($p['nom']) ?></strong><br>
                <?= htmlspecialchars($p['adresse']) ?><br>
                <?= htmlspecialchars($p['description']) ?><br>
                <form action="reservation.php" method="GET">
                    <input type="hidden" name="partenaire" value="<?= htmlspecialchars($p['nom']) ?>">
                    <button type="submit" class="bouton-reserver">Réserver</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="mapid"></div>
</div>

<img src="../../images/footernutritium.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter">
<img src="../../images/déconnexion2.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion"
     onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">

<footer>
    <div class="footer">
        <nav>
            <ul>
                <li><a href="CGU.php" target="_blank">C.G.U</a></li>
                <li><a href="https://www.isep.fr/" target="_blank">Nos investisseurs</a></li>
                <li><a href="faq.php" target="_blank">Contact</a></li>
            </ul>
        </nav>
    </div>
</footer>

<script src="../js/commande.js"></script>

<script>
    var map = L.map('mapid').setView([48.8566, 2.3522], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const partenaires = <?= json_encode($partenaires) ?>;

    partenaires.forEach(p => {
        L.marker([p.latitude, p.longitude])
            .addTo(map)
            .bindPopup(p.nom);
    });
</script>
</body>
</html>

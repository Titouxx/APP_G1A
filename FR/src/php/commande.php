<?php
$pageCSS = '../css/commande.css';
$pageTitle = 'Commander un panier - Nutritium';
$useLeaflet = true;
include '../include/header.php';


// Sécurité
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

// Récupération des partenaires
try {
    $stmt = $pdo->query("SELECT * FROM partenaires");
    $partenaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();

    include '../include/footer.php';
    exit();
}
?>

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
<div class="spacer"></div>
<!--<img src="../../images/footernutritium.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter">-->

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
const map = L.map('mapid').setView([48.8566, 2.3522], 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

window.addEventListener('load', () => {
    setTimeout(() => {
        map.invalidateSize();
    }, 200);
});
const partenaires = <?= json_encode($partenaires) ?>;
partenaires.forEach(p => {
    L.marker([p.latitude, p.longitude])
        .addTo(map)
        .bindPopup(p.nom);
});


</script>

<!-- Script spécifique à cette page -->
<script src="../js/commande.js"></script>

<?php include '../include/footer.php'; ?>
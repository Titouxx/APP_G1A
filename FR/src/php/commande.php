<?php
$pageCSS = '../css/commande.css';
$pageTitle = 'Commander un panier - Nutritium';
$useLeaflet = true;
include '../include/header.php';

// Sécurité
if (!isset($_SESSION['logged_in'])) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

$peutReserver = true;

if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT date_reservation FROM reservations_archive 
                             WHERE user_id = ? AND date_reservation >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                             ORDER BY date_reservation DESC LIMIT 1");
        $stmt->execute([$_SESSION['user_id']]);
        $derniereReservation = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $peutReserver = !$derniereReservation;
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM partenaires");
    $partenaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
    include '../include/footer.php';
    exit();
}

$panierEnCours = isset($_SESSION['panier_en_cours']);

if (isset($_GET['partenaire']) && !$panierEnCours) {
    $_SESSION['panier_en_cours'] = [
        'partenaire_nom' => urldecode($_GET['partenaire']),
        'date_creation' => date('Y-m-d H:i:s')
    ];
    header("Location: reservation.php");
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
            <form action="commande.php" method="GET" class="form-reservation">
                <input type="hidden" name="partenaire" value="<?= htmlspecialchars($p['nom']) ?>">
                <button type="submit" class="bouton-reserver">
                    Réserver
                </button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="mapid"></div>
</div>

<!-- Ajout de cette div pour les messages d'alerte -->
<div id="reservation-alert" class="alert-hidden"></div>

<script>
// Données à passer au JavaScript
const reservationData = {
    panierEnCours: <?= $panierEnCours ? 'true' : 'false' ?>,
    peutReserver: <?= $peutReserver ? 'true' : 'false' ?>,
    dernierPartenaire: '<?= $panierEnCours ? htmlspecialchars($_SESSION['panier_en_cours']['partenaire_nom']) : '' ?>'
};
</script>
<div class="spacer"></div>

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

<script src="../js/commande.js"></script>

<?php include '../include/footer.php'; ?>
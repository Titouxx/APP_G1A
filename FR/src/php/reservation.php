<?php
$pageCSS = '../css/reservation.css';
$pageTitle = 'Réservation - Nutritium';
include '../include/header.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

$panierEnCours = isset($_SESSION['panier_en_cours']);
$reservationActive = null;
$qrCode = null;

if ($panierEnCours) {
    $partenaireNom = $_SESSION['panier_en_cours']['partenaire_nom'];
    
    $stmt = $pdo->prepare("SELECT * FROM partenaires WHERE nom = ?");
    $stmt->execute([$partenaireNom]);
    $partenaire = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($partenaire) {
        $stmt = $pdo->prepare("SELECT * FROM paniers WHERE partenaire_id = ?");
        $stmt->execute([$partenaire['id']]);
        $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($panier) {
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE panier_id = ?");
            $stmt->execute([$panier['id']]);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

$stmt = $pdo->prepare("SELECT r.*, p.nom as partenaire_nom, p.adresse, pan.nom as panier_nom, pan.description 
                      FROM reservations r
                      JOIN partenaires p ON r.partenaire_id = p.id
                      JOIN paniers pan ON r.panier_id = pan.id
                      WHERE r.user_id = ?
                      ORDER BY r.date_reservation DESC 
                      LIMIT 1");
$stmt->execute([$_SESSION['user_id']]);
$derniereReservation = $stmt->fetch(PDO::FETCH_ASSOC);

if ($derniereReservation) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE panier_id = ?");
    $stmt->execute([$derniereReservation['panier_id']]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmer']) && $panierEnCours) {
            
        if ($panier) {
            $qrDir = '../qrcodes/';
            if (!file_exists($qrDir)) {
                mkdir($qrDir, 0755, true);
            }

            require_once '../lib/phpqrcode/qrlib.php';
            $qrContent = "Nutritium|".$_SESSION['user_id']."|".$partenaire['id']."|".$panier['id']."|".time();
            $qrFile = $qrDir.md5($qrContent).'.png';

            if (extension_loaded('gd')) {
                QRcode::png($qrContent, $qrFile);
            } else {
                file_put_contents($qrFile, "QR Code content: ".$qrContent);
                die("L'extension GD n'est pas disponible pour générer les QR codes");
            }

            $stmt = $pdo->prepare("INSERT INTO reservations (user_id, partenaire_id, panier_id, qr_code, date_reservation) 
                                VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([
                $_SESSION['user_id'],
                $partenaire['id'],
                $panier['id'],
                basename($qrFile)
            ]);
            
            header("Location: reservation.php");
            exit();
        }
    }
    elseif (isset($_POST['annuler'])) {
        unset($_SESSION['panier_en_cours']);
        header("Location: reservation.php");
        exit();
    }
    elseif (isset($_POST['archiver']) && $derniereReservation) {
        try {
            $pdo->beginTransaction();
            
            $stmt = $pdo->prepare("INSERT INTO reservations_archive 
                                (user_id, partenaire_id, panier_id, qr_code, date_reservation, date_archivage) 
                                VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->execute([
                $derniereReservation['user_id'],
                $derniereReservation['partenaire_id'],
                $derniereReservation['panier_id'],
                $derniereReservation['qr_code'],
                $derniereReservation['date_reservation']
            ]);
            
            $pdo->prepare("DELETE FROM reservations WHERE id = ?")
                ->execute([$derniereReservation['id']]);
            
            $pdo->commit();
            
            unset($_SESSION['panier_en_cours']);
            header("Location: reservation.php");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("Erreur lors de l'archivage: " . $e->getMessage());
            die("Une erreur est survenue lors de l'archivage de la réservation.");
        }
    }
}

$peutReserver = true;

if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT date_reservation FROM reservations_archive 
                             WHERE user_id = ? AND date_reservation >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                             ORDER BY date_reservation DESC LIMIT 1");
        $stmt->execute([$_SESSION['user_id']]);
        $reservation_archivee = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $peutReserver = !$reservation_archivee;
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
    }
}
?>

<h1>Votre panier Nutritium</h1>

<div class="reservation-container">
    <?php if ($derniereReservation): ?>
    <div class="reservation-active">
        <h2>Réservation active</h2>
        <p>Partenaire : <?= htmlspecialchars($derniereReservation['partenaire_nom']) ?></p>
        <p>Adresse : <?= htmlspecialchars($derniereReservation['adresse']) ?></p>
        <p>Date de réservation : <?= date('d/m/Y H:i', strtotime($derniereReservation['date_reservation'])) ?></p>

        <div class="panier-details">
            <h3><?= htmlspecialchars($derniereReservation['panier_nom']) ?></h3>
            <p><?= htmlspecialchars($derniereReservation['description']) ?></p>

            <h4>Contenu du panier :</h4>
            <?php if (!empty($articles)): ?>
            <ul>
                <?php foreach ($articles as $article): ?>
                <li><?= htmlspecialchars($article['nom']) ?> - <?= htmlspecialchars($article['quantite']) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p>Aucun article disponible dans ce panier.</p>
            <?php endif; ?>
        </div>

        <div class="qr-code-container">
            <img src="../../qrcodes/<?= htmlspecialchars($derniereReservation['qr_code']) ?>" alt="QR Code">
            <p>Présentez ce code au partenaire pour récupérer votre panier.</p>
        </div>

        <form method="post">
            <button type="submit" name="archiver" class="bouton-annuler">Archiver la réservation</button>
        </form>
    </div>
    <?php elseif ($panierEnCours): ?>
    <div class="reservation-en-cours">
        <h2>Réservation en attente de confirmation</h2>
        <p>Partenaire : <?= htmlspecialchars($_SESSION['panier_en_cours']['partenaire_nom']) ?></p>
        <p>Date de création : <?= date('d/m/Y H:i', strtotime($_SESSION['panier_en_cours']['date_creation'])) ?></p>

        <div class="panier-standard">
            <h3>Panier repas standard</h3>
            <div class="panier-articles">
                <h3>Contenu du panier :</h3>
                <?php if (!empty($articles)): ?>
                <ul>
                    <?php foreach ($articles as $article): ?>
                    <li><?= htmlspecialchars($article['nom']) ?> - <?= htmlspecialchars($article['quantite']) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>Aucun article disponible dans ce panier.</p>
                <?php endif; ?>
            </div>
        </div>

        <form method="post" class="form-actions">
            <button type="submit" name="annuler" class="bouton-annuler">Annuler</button>
            <button type="submit" name="confirmer" class="bouton-confirmer">Confirmer</button>
        </form>

        <div class="reservation-warning">
            <p>Attention : Vous n'avez le droit qu'à un panier par semaine.</p>
        </div>
    </div>
    <?php elseif (!$peutReserver): ?>
    <div class="no-reservation">
        <h2>Vous avez déjà réservé un panier cette semaine</h2>
        <?php $dateProchaineReservation = date('d/m/Y à H:i', strtotime($reservation_archivee['date_reservation'] . ' + 7 days'));?>
        <p>Veuillez attendre jusqu'au <?= $dateProchaineReservation ?> pour réserver un nouveau panier.</p>
    </div>
    <?php else: ?>
    <div class="no-reservation">
        <h2>Aucune réservation active</h2>
        <p>Vous n'avez actuellement aucun panier réservé.</p>
        <p>Pour réserver un panier, visitez un de nos partenaires :</p>
        <a href="commande.php" class="bouton-partenaire">Voir nos partenaires</a>
    </div>
    <?php endif; ?>
</div>

<?php include '../include/footer.php'; ?>
<script src="../js/reservation.js" defer></script>
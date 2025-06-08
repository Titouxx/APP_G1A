<?php
$pageCSS = '../css/espaceuser.css';
include '../include/header.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

// Requête pour récupérer la dernière réservation de l'utilisateur
$lastReservation = null;

try {
    $stmt = $pdo->prepare("
        SELECT 
            r.date_reservation,
            p.nom AS partenaire_nom,
            pa.nom AS panier_nom
        FROM 
            reservations r
        JOIN 
            partenaires p ON r.partenaire_id = p.id
        JOIN 
            paniers pa ON r.panier_id = pa.id
        WHERE 
            r.user_id = :user_id
        ORDER BY 
            r.date_reservation DESC
        LIMIT 1
    ");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $lastReservation = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $lastReservation = null;
}
?>

<!-- Section de bienvenue -->
<div class="welcome-section">
    <h1>Bienvenue dans votre espace !</h1>
</div>

<!-- Résumé rapide utilisateur -->
<div class="user-summary">
    <h2><?= htmlspecialchars($_SESSION['prenom'] ?? 'Utilisateur') ?> 👋</h2>
    <p>Email : <?= htmlspecialchars($_SESSION['email'] ?? '') ?></p>
    <p>Statut : <?= htmlspecialchars($_SESSION['statut'] ?? 'non défini') ?></p>
</div>

<!--Historique ou résumé
<div class="history-preview">
    <h3>Votre dernière réservation</h3>
    <?php if ($lastReservation): ?>
        <p><strong>Panier :</strong> <?= htmlspecialchars($lastReservation['panier_nom']) ?></p>
        <p><strong>Partenaire :</strong> <?= htmlspecialchars($lastReservation['partenaire_nom']) ?></p>
        <p><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($lastReservation['date_reservation'])) ?></p>
    <?php else: ?>
        <p>Aucune réservation récente.</p>
    <?php endif; ?>
</div>-->

<!-- Actions principales en image -->
<div class="main">
    <div class="img1">
        <figure>
            <a href="Profil.php">
                <img src="../../images/profil.png" alt="Profil" />
                <div class="image-text">Modifier</div>
            </a>
        </figure>
    </div>

    <div class="img2">
        <figure>
            <a href="reservation.php">
                <img src="../../images/commandebutton.png" alt="Commander" />
                <div class="image-text2">Panier</div>
            </a>
        </figure>
    </div>
</div>

<?php include '../include/footer.php'; ?>
<script src="../js/espaceuser.js"></script>

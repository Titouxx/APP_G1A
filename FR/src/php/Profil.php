<?php
$pageCSS = '../css/Profil.css';
$pageTitle = 'Profil - Nutritium';
include '../include/header.php'; // session_start() est dedans

if (!isset($_SESSION['user_id'])) {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

$user_id = (int) $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT prenom, nom, email, telephone, adresse, ville FROM user WHERE id_User = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<div class='alert alert-danger'>Utilisateur introuvable.</div>";
        include '../include/footer.php';
        exit();
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur SQL : " . $e->getMessage() . "</div>";
    include '../include/footer.php';
    exit();
}
?>

<div class="profile-container">
    <h1>Mes Informations</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert-success">Profil mis à jour avec succès.</div>
    <?php endif; ?>

    <form method="post" action="update_profile.php" class="profile-form">
        <div class="form-row">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($user['nom'] ?? '') ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" value="<?= htmlspecialchars($user['telephone'] ?? '') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" value="<?= htmlspecialchars($user['ville'] ?? '') ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<?php include '../include/footer.php'; ?>

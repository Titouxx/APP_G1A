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
                <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" value="<?= htmlspecialchars($user['telephone']) ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse']) ?>">
            </div>
            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="ville" value="<?= htmlspecialchars($user['ville']) ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>

    <hr>

    <h2>Changer le mot de passe</h2>

<div class="password-update-form">
    <form id="passwordForm">
        <div class="form-group">
            <label>Mot de passe actuel</label>
            <input type="password" name="oldPassword" required>
        </div>
        <div class="form-group">
            <label>Nouveau mot de passe</label>
            <input type="password" name="newPassword" id="newPassword" required>
        </div>
        <div class="form-group">
            <label>Confirmer le nouveau mot de passe</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
        </div>
        <div class="form-actions">
            <button type="submit">Modifier le mot de passe</button>
        </div>
    </form>
    <div id="passwordMessage" style="margin-top: 10px;"></div>
</div>

<script>
document.getElementById('passwordForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const msg = document.getElementById('passwordMessage');

    if (newPassword !== confirmPassword) {
        msg.innerHTML = '<span style="color: red;">Les mots de passe ne correspondent pas.</span>';
        return;
    }

    const form = new FormData(this);
    const response = await fetch('update_password.php', {
        method: 'POST',
        body: form
    });

    const data = await response.json();

    if (data.status === 'success') {
        msg.innerHTML = '<span style="color: green;">Mot de passe mis à jour avec succès.</span>';
        this.reset();
    } else {
        msg.innerHTML = '<span style="color: red;">' + data.message + '</span>';
    }
});
</script>


<?php include '../include/footer.php'; ?>

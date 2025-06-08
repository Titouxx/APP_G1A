<?php
$pageCSS = '../css/admin.css';
$pageTitle = 'Administration - Nutritium';
include '../include/header.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['statut'] !== 'admin') {
    header("Location: Connexion.php");
    exit();
}

require_once 'connectSQL.php';
$pdo = getPDOConnection();

// Suppression d’un partenaire
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM partenaires WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: admin.php");
    exit();
}

// Ajout d’un nouveau partenaire
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare("INSERT INTO partenaires (nom, adresse, description, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nom'],
        $_POST['adresse'],
        $_POST['description'],
        $_POST['latitude'],
        $_POST['longitude']
    ]);
    header("Location: admin.php");
    exit();
}

// Données
$partenaires = $pdo->query("SELECT * FROM partenaires")->fetchAll(PDO::FETCH_ASSOC);
$users = $pdo->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- CONTENU ADMIN -->
<main class="admin-container">
    <section class="left-panel">
        <h2>Partenaires</h2>
        <ul>
            <?php foreach ($partenaires as $p): ?>
            <li>
                <strong><?= htmlspecialchars($p['nom']) ?></strong><br>
                <small><?= htmlspecialchars($p['adresse']) ?></small><br>
                <a href="?delete_id=<?= $p['id'] ?>" class="delete-btn">Supprimer</a>
            </li>
            <?php endforeach; ?>
        </ul>

        <h3>Ajouter un partenaire</h3>
        <form method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="adresse" placeholder="Adresse" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" step="any" name="latitude" placeholder="Latitude" required>
            <input type="number" step="any" name="longitude" placeholder="Longitude" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    </section>

    <section class="right-panel">
        <h2>Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nom']) ?></td>
                    <td><?= htmlspecialchars($u['prenom']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['statut']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php include '../include/footer.php'; ?>
<script src="../js/commande.js"></script>
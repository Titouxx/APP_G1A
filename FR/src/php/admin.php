<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['statut'] !== 'admin') {
    header("Location: Connexion.php");
    exit();
}

$host = 'localhost';
$db   = 'siteweb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Admin - Nutritium</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/commande.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<!-- MENU + LOGO -->
<header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin'): ?>
                <li><a href="admin.php">Administration</a></li>
            <?php else: ?>
                <li><a href="commande.php">Commander un panier</a></li>
            <?php endif; ?>
            <li><a href="espaceuser.php">Profil</a></li>
        </ul>
    </nav>
</header>

<a href="index.php">
    <img src="../../images/logonutritium.png" id="Logo1" alt="Logo Nutritium" title="Logo Nutritium">
</a>


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

<script src="../js/commande.js"></script>
</body>
</html>

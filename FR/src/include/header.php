<?php
session_start();

if (!isset($pageCSS)) {
    $pageCSS = '../css/index.css';
}
if (!isset($pageTitle)) {
    $pageTitle = 'Akatsuki - Nutritium';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- 1. CSS du Header -->
    <link rel="stylesheet" href="../css/header.css">

    <!-- 2. CSS spécifique à la page -->
    <link rel="stylesheet" href="<?= htmlspecialchars($pageCSS); ?>">

    <!-- 3. CSS du Footer -->
    <link rel="stylesheet" href="../css/footer.css">

    <link rel="icon" type="image/x-icon" href="../../images/logonutritium.ico">
    <script src="../js/jquery.min.js"></script>

    <?php if (!empty($useLeaflet)) : ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <?php endif; ?>

    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
<header class="main-header">
    <div class="header-container">
        <a href="index.php">
            <img src="../../images/logonutritium.png" id="Logo1" alt="Logo Nutritium" title="Logo Nutritium">
        </a>

        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="commande.php">Commander un panier</a></li>
                <li><a href="espaceuser.php">Profil</a></li>
            </ul>
        </nav>
    </div>
</header>



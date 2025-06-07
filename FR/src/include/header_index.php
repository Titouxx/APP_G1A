<?php
session_start();

if (!isset($pageCSS)) {
    $pageCSS = 'css/index.css';
}
if (!isset($pageTitle)) {
    $pageTitle = 'Akatsuki - Nutritium';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header CSS -->
    <link rel="stylesheet" href="css/header.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?= htmlspecialchars($pageCSS); ?>">
    <!-- Footer CSS -->
    <link rel="stylesheet" href="css/footer.css">

    <link rel="icon" type="image/x-icon" href="images/logonutritium.ico">
    <script src="js/jquery.min.js"></script>

    <?php if (!empty($useLeaflet)) : ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <?php endif; ?>

    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>

<body>

    <header class="main-header">
        <div class="header-bar">
            <!-- Logo -->
            <div class="logo-container">
                <a href="index.php">
                    <img src="../images/logonutritium.png" alt="Logo Nutritium">
                </a>
            </div>

            <!-- Navigation links -->
            <nav class="menu">
                <a href="index.php">Home</a>
                <a href="php/commande.php">Commander un panier</a>
                <a href="php/espaceuser.php">Mon espace</a>
            </nav>

            <!-- User greeting -->
            <?php if (isset($_SESSION['prenom'])) : ?>
            <div class="user-greeting">Hi <?= htmlspecialchars($_SESSION['prenom']) ?> !</div>
            <?php endif; ?>
        </div>
    </header>
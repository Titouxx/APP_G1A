<?php
<<<<<<< Updated upstream
session_start();
=======
$pageCSS = '../css/Profil.css';
$pageTitle = 'Profil - Nutritium';
include '../include/header.php';
>>>>>>> Stashed changes

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
    $user = $stmt->fetch();

    if (!$user) {
        echo "Aucun utilisateur trouvé.";
<<<<<<< Updated upstream
=======
        include '../include/footer.php';
>>>>>>> Stashed changes
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
<<<<<<< Updated upstream
=======
    include '../include/footer.php';
>>>>>>> Stashed changes
    exit();
}
?>

<<<<<<< Updated upstream
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Akatsuki - Nutritium</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/Profil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../images/logonutritium%20-%20Copie.ico" />
</head>

<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="commande.php">Commander un panier</a></li>
            <li><a href="espaceuser.php">Profil</a></li>
        </ul>
    </nav>
</header>

<a href="index.php">
    <img src="../../images/logonutritium.png" id="Logo1" alt="Logo EchoKey" title="Logo EchoKey">
</a>

=======

>>>>>>> Stashed changes
<div class="ii">
    <div class="container1">
        <div class="content">
            <div class="sidebar">
                <ul class="menu2">
                    <li>
                        <label class="label_menu">
                            <img class="menu-icon" src="../../images/profil.png" alt="Users Icon"/>
                            <button onclick="showSection('coordonnees')">Coordonnées</button>
                        </label>
                    </li>
                    <li>
                        <label class="label_menu">
                            <img class="menu-icon" src="../../images/parametres-des-engrenages.png" alt="Paramètres"/>
                            <button onclick="showSection('parametres')">Paramètres</button>
                        </label>
                    </li>
                </ul>
                <button class="Déconnexion" onclick="window.location.href='logout.php'">
                    <img class="menu-icon" src="../../images/se-deconnecter.png" alt="Exit Icon"/>
                    Déconnexion
                </button>
            </div>

            <div class="profile-info">
                <h1>Édition du Profil</h1>

                <div id="coordonnees" class="section profile" style="display: none">
<<<<<<< Updated upstream
                    <div class="form-group mb-3">
                        <label class="col-md-4 control-label">Prénom</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['prenom']) ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-md-4 control-label">Nom</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['nom']) ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['email']) ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Téléphone</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['telephone']) ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label class="col-md-4 control-label">Adresse</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['adresse']) ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Ville</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user['ville']) ?>" disabled />
                            </div>
                        </div>
                    </div>
=======
                    <?php foreach (['prenom', 'nom', 'email', 'telephone', 'adresse', 'ville'] as $field): ?>
                        <div class="form-group mb-3">
                            <label class="col-md-4 control-label"><?= ucfirst($field) ?></label>
                            <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-<?= $field === 'email' ? 'envelope' : ($field === 'telephone' ? 'earphone' : 'user') ?>"></i>
                                    </span>
                                    <input class="form-control" type="text" value="<?= htmlspecialchars($user[$field]) ?>" disabled />
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
>>>>>>> Stashed changes
                </div>

                <div id="parametres" class="section profile" style="display: none">
                    <h5>Modifier votre mot de passe</h5>
                    <div class="form-group mb-3">
                        <label>Mot de passe actuel</label>
                        <input id="current_password" class="form-control" type="password" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Nouveau mot de passe</label>
                        <input id="new_password" class="form-control" type="password" />
                    </div>
                    <div class="form-group">
                        <label>Confirmer le mot de passe</label>
                        <input id="confirm_password" class="form-control" type="password" />
                        <span id="passwordError" style="color:red;"></span>
                    </div>
                </div>

                <button class="Edition" onclick="activerEdition()">Modifier</button>
                <button class="Edition" id="Enregistrer" style="display: none" onclick="enregistrerEdition()">Enregistrer</button>
                <button class="Edition" id="Maj" style="display: none" onclick="majPassword()">Mettre à jour</button>
                <button class="Edition" id="AnnulerEdition" style="display: none" onclick="annulerEdition()">Annuler</button>
            </div>
        </div>
    </div>
</div>

<<<<<<< Updated upstream
<footer>
    <div class="footer">
        <img src="../../images/footernutritium.png" id="LogosFooter" alt="LogosFooter" />
        <nav>
            <ul>
                <li><a href="CGU.php" target="_blank">C.G.U</a></li>
                <li><a href="https://www.isep.fr/" target="_blank">Nos investisseurs</a></li>
                <li><a href="faq.php" target="_blank">Contact</a></li>
            </ul>
        </nav>
    </div>
</footer>
<script src="../js/Profil.js"></script>
</body>
</html>
=======
<script src="../js/Profil.js"></script>
<?php include '../include/footer.php'; ?>
>>>>>>> Stashed changes

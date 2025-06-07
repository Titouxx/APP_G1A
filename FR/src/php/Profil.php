<?php
$pageCSS = '../css/Profil.css';
$pageTitle = 'Profil - Nutritium';
include '../include/header.php';

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
        include '../include/footer.php';
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
    include '../include/footer.php';
    exit();
}
?>

<div class="ii">
    <div class="container1">
        <div class="content">
            <div class="sidebar">
                <ul class="menu2">
                    <li>
                        <label class="label_menu">
                            <img class="menu-icon" src="../../images/profil.png" alt="Users Icon" />
                            <button onclick="showSection('coordonnees')">Coordonnées</button>
                        </label>
                    </li>
                    <li>
                        <label class="label_menu">
                            <img class="menu-icon" src="../../images/parametres-des-engrenages.png" alt="Paramètres" />
                            <button onclick="showSection('parametres')">Paramètres</button>
                        </label>
                    </li>
                </ul>
                <button class="Déconnexion" onclick="window.location.href='logout.php'">
                    <img class="menu-icon" src="../../images/se-deconnecter.png" alt="Exit Icon" />
                    Déconnexion
                </button>
            </div>

            <div class="profile-info">
                <h1>Édition du Profil</h1>

                <div id="coordonnees" class="section profile" style="display: none">
                    <?php foreach (['prenom', 'nom', 'email', 'telephone', 'adresse', 'ville'] as $field): ?>
                    <div class="form-group mb-3">
                        <label class="col-md-4 control-label"><?= ucfirst($field) ?></label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i
                                        class="glyphicon glyphicon-<?= $field === 'email' ? 'envelope' : ($field === 'telephone' ? 'earphone' : 'user') ?>"></i>
                                </span>
                                <input class="form-control" type="text" value="<?= htmlspecialchars($user[$field]) ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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
                <button class="Edition" id="Enregistrer" style="display: none"
                    onclick="enregistrerEdition()">Enregistrer</button>
                <button class="Edition" id="Maj" style="display: none" onclick="majPassword()">Mettre à jour</button>
                <button class="Edition" id="AnnulerEdition" style="display: none"
                    onclick="annulerEdition()">Annuler</button>
            </div>
        </div>
    </div>
</div>

<script src="js/Profil.js"></script>
<?php include '../include/footer.php'; ?>
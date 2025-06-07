<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akatsuki - Nutritium</title>
    <link rel="stylesheet" href="css/Connexion.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>

  <body background="../../images/background.png">

    <!--Formulaire de connexion-->
    <div class="wrapper" id="loginWrapper">
      <form id="loginForm" action="login.php" method="post">
        <h1>Se connecter</h1>
        <div class="input-box">
          <input type="text" id="loginEmail" name="loginEmail" placeholder="Email" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input
            type="password"
            id="loginPassword"
            name="loginPassword"
            placeholder="Mot de passe"
            required
          />
          <i class="bx bxs-lock-alt"></i>
        </div>

        <div class="remember-forgot">
          <label><input type="checkbox" /> Se souvenir de moi</label>
          <a href="#">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="btn">Se connecter</button>
        <p>Compte inexistant ?</p>
        <button type="button" id="registerBtn" class="btn">S'enregistrer</button>
      </form>
    </div>

    <!-- Formulaire d'enregistrement -->
    <div class="wrapper2" id="registerWrapper" style="display: none">
      <form id="registerForm" action="register.php" method="post">
        <h1>Enregistrement</h1>
        <div class="name-fields">
          <div class="input-box">
            <input type="text" id="registerFirstName" name="registerFirstName" placeholder="Prénom" required />
            <i class="bx bxs-user"></i>
          </div>
          <div class="input-box">
            <input type="text" id="registerLastName" name="registerLastName" placeholder="Nom" required />
            <i class="bx bxs-user"></i>
          </div>
        </div>

        <div class="input-box">
          <input type="text" id="registerEmail" name="registerEmail" placeholder="Email" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="password" id="registerPassword" name="registerPassword" placeholder="Mot de passe" required />
          <i class="bx bxs-lock-alt"></i>
        </div>
        <div class="input-box">
          <input type="password" id="RepeatPassword" name="RepeatPassword" placeholder="Répéter le mot de passe" required />
          <i class="bx bxs-lock-alt"></i>
        </div>

        <!-- Champ caché pour définir le statut par défaut -->
        <input type="hidden" name="statut" value="etudiant" />

        <button type="submit" class="btn">S'enregistrer</button>
        <p>J'ai déjà un compte</p>
        <button type="button" id="loginBtn" class="btn">Se connecter</button>
      </form>
    </div>

    <script src="js/connexion.js"></script>
  </body>
</html>

<?php
session_start(); // Démarre la session au début du script
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="../css/index.css" rel="stylesheet" />
    <script src="../js/jquery.min.js"></script>
   
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <title>TransNoise - EchoKey</title>
    
    
  </head>

  <!--header gere la barre du haut de l'écran-->

  <header>
    <nav>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analyse</a></li>
        <li><a href="faq.php">Faq</a></li>
        <li><a href="espaceuser.php">Profil</a></li>
      </ul>
    </nav>
  </header>
  <!--body gere le corp de la page-->
  <body>
    <!--le logo en haut à gauche-->
    <img
      src="../../images/EchoKey_extrude.png"
      id="Logo1"
      alt="Logo EchoKey"
      title="Logo EchoKey"
    />

    <!--gere le texte au milieu de la page-->
    <div class="content">
      <h1>
        Trouvez
        <br />
        Votre <br />
        Voix
      </h1>
      <img src="../../images/Image_index.jpeg" alt="chanteur" height="300px" />
    </div>
    <div class="content-container">
      <div class="left">
        <h1 class="Echokey">Echokey</h1>
        <p class="paragraphe">
          Beaucoup d'artiste ne dispose pas d'analyse précise de leur
          performance. Echokey propose une solution innovante, en plaçant des
          capteurs dernier cri dans les plus grandes salle parisiennes tel que
          l'Olympia, l'Opera Garnier ou encore le Bataclan. Ces données ainsi
          collecté par nos capteurs sont analysé et un rapport graphique est
          directement envoyé a nos clients.
        </p>
      </div>
      <div class="right">
        <h1>
          Déjà plus de<br /><span>7 098 personnes </span><br />ont confiance
          en notre expertise
        </h1>
      </div>
    </div>
    <div class="buton">
     
<?php
if(isset($_SESSION['user_id'])) {
  // Si l'utilisateur est connecté, affichez un message différent
  echo '<p>Bienvenue ' . $_SESSION['email'] . '</p>';
  echo '<button class="cn" id="scrollButton"><a href="logout.php">Souhaitez vous vous déconnecter</a></button>';
} else {
  // Si l'utilisateur n'est pas connecté, affichez le bouton de connexion
  echo '<button class="cn" id="scrollButton"><a href="Connexion.php">Connectez Vous !</a></button>';
}
?>
      </button>
    </div>

  <!--footer gere le bas de page-->
  <img src="../../images/collage.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter"> <!--logo Transnoise-->
  <li>
  <!--logo déconnexion-->
  <img src="../../images/déconnexion_test.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">
</li>
<footer>
  <div class="footer">
  <nav>
    <ul>
      <li><a href="CGU.php" id="ga" target="_blank">C.G.U</a></li>
      <li><a href="https://www.isep.fr/" id="ga" target="_blank">Nos investisseurs</a></li>
      <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
    </ul>
  </nav>
</div>
</footer>
<script src="../js/index.js"></script>
</body>
</html>

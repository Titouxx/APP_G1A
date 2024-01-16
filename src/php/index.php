<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="../css/index.css" rel="stylesheet" />
    <script src="../js/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <title>TransNoise - EchoKey</title>
    <style>
      #scrollButton{
        visibility: visible;
      }
    </style>
    <?php
    if(isset($_SESSION['user_id'])) {
      echo 'la variable existe';
      echo "<script>
          console.log('Script exécuté');
          document.getElementById('scrollButton').style.visibility = 'hidden';
      </script>";
  }
    ?>
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
      <button class="cn" id="scrollButton">
        <a href="Connexion.php">Connectez Vous !</a>
      </button>
    </div>
  </body>

  <!--footer gere le bas de page-->
  <footer>
    <div class="footer">
      <nav>
        <ul>
          <li><a href="CGU.php" target="_blank">C.G.U</a></li>
          <li>
            <a href="https://www.isep.fr/" target="_blank">Nos investisseurs</a>
          </li>
          <li><a href="faq.php" target="_blank">Contact</a></li>
        </ul>
      </nav>
    </div>
  </footer>
</html>

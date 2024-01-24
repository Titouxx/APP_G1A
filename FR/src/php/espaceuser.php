<?php
// Démarrez la session au début de chaque page PHP
session_start();

// Assurez-vous que l'utilisateur est connecté avant de procéder
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: Connexion.php");
    exit();
}?>
<?php 
// // Make sure page can only be accessed when user is connected if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { // Redirect user to login page if not connected header("Location: Connexion.php"); exit(); }?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>TransNoise - EchoKey</title>
    <link rel="stylesheet" href="../css/normalize-user.css" />
    <link rel="stylesheet" href="../css/espaceuser.css" />
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
  </head>
  <body background="../../images/bgtest2.png">
    <nav>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analyse</a></li>
        <li><a href="faq.php">Faq</a></li>
        <li><a href="espaceuser.php">Profil</a></li>
      </ul>
    </nav>

    <div class="header" style="width: 100%; height: 25%; float: left">
      <h1>Bienvenue dans votre espace !</h1>
    </div>

    <div class="main" style="width: 100%; height: 80%; float: left">
      <div class="img1" style="margin-top: 200px">
        <figure>
          <a href="profil.php">
            <img src="../../images/img-profil.png" id="img-profil" />
            <div class="image-text">profil</div>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img2" style="margin-top: 200px">
        <figure>
          <a href="analyse.php">
            <img src="../../images/img-analyse.png" id="img-analyse" />
            <div class="image-text2">analyse</div>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img3" style="margin-top: 200px">
        <figure>
          <a href="forum.php">
            <img src="../../images/img-forum.png" id="img-forum" />
            <div class="image-text3">forum</div>
          </a>
        </figure>
        <span></span>
      </div>
      <div class="news" style="margin-top: 200px">
        <img src="../../images/img-news.png" id="img-news" />
      </div>
    </div>
    <div class="tab" id="pullTab">
      <h2 style="text-align: center">Les Actualités De La Semaine</h2>
      <div class="art1">
        <img
          src="../../images/reseauxsociaux.jpg"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
          Article 1: "L'Émergence des Artistes Indépendants dans l'Industrie
          Musicale"
        </h3>
        <p style="text-align: left">
          Dans le monde en constante évolution de la musique, une tendance
          marquante se dessine avec l'émergence croissante d'artistes
          indépendants. Grâce à l'avènement des plateformes de streaming et des
          réseaux sociaux, les musiciens peuvent désormais atteindre un public
          mondial sans l'aide des grandes maisons de disques. Cette liberté
          artistique accrue permet aux talents émergents de créer et de partager
          leur musique de manière authentique, en contournant les barrières
          traditionnelles de l'industrie musicale. L'autonomie accrue des
          artistes indépendants ouvre de nouvelles perspectives passionnantes,
          redéfinissant ainsi la dynamique de l'industrie musicale
          contemporaine.
        </p>
        <br />
      </div>
      <div class="art2">
        <img
          src="../../images/operatech.png"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
          Article 2: "L'Intégration de la Technologie dans les Productions
          Opéra"
        </h3>
        <p style="text-align: left">
          L'opéra, un art millénaire, se réinvente à l'ère technologique. Les
          productions opéra intègrent de plus en plus de technologies
          avant-gardistes pour créer des expériences visuelles et sonores
          uniques. Des projections 3D aux effets spéciaux novateurs, les scènes
          opératiques sont transformées, offrant aux spectateurs une immersion
          encore jamais vue. Ces avancées technologiques permettent aux
          compagnies d'opéra d'explorer de nouvelles interprétations des
          classiques tout en attirant un public plus diversifié et en
          renouvelant l'intérêt pour cet art traditionnel.
        </p>
        <br />
      </div>
      <div class="art3">
        <img
          src="../../images/musiqueimmersive.jpg"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
          Article 3: "La Révolution de la Musique Immersive"
        </h3>
        <p style="text-align: left">
          Une révolution silencieuse secoue le monde de la musique avec
          l'avènement de l'audio immersif. Les technologies audio 3D et les
          casques de réalité virtuelle offrent une expérience musicale
          totalement nouvelle, plaçant l'auditeur au cœur de la musique. Des
          artistes expérimentent avec des techniques de production audio
          novatrices pour créer des morceaux qui résonnent différemment selon
          l'endroit où se trouve l'auditeur dans l'espace virtuel. Cette
          tendance transforme la manière dont nous percevons et apprécions la
          musique, repoussant les limites de la créativité et ouvrant de
          nouvelles perspectives pour l'avenir de l'industrie musicale.
        </p>
      </div>
    </div>

    <img src="../../images/collage.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter"> <!--logo Transnoise-->
  <li>
    <!--logo déconnexion-->
    <img src="../../images/déconnexion_test.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">
  </li>
<footer>
  <div class="footer">
  <nav>
    <ul>
      <li><a href="CGU.php" id="ga" target="_blank">T&Cs</a></li>
      <li><a href="https://www.isep.fr/" id="ga" target="_blank">Our Investors</a></li>
      <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
    </ul>
  </nav>
</div>
</footer>
    <script src="../js/espaceuser.js"></script>
  </body>
</html>

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

    <div class="main" style="width: 100%;height: 80%;float: left">
      <div class="img1" style="margin-top: 200px">
        <figure>
          <a href="profil.php">
            <img src="../../images/img-profil.png" id="img-profil"/>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img2" style="margin-top: 200px">
        <figure>
          <a href="analyse.php">
            <img src="../../images/img-analyse.png" id="img-analyse"/>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img3" style="margin-top: 200px">
        <figure>
          <a href="forum.php">
            <img src="../../images/img-forum.png" id="img-forum" />
          </a>
        </figure>
        <span></span>
      </div>
      <div class="news" style="margin-top: 200px;">
        <img src="../../images/img-news.png" id="img-news"/>
      </div>
    </div>
    <div class="tab" id="pullTab">
      <h2> Les Actualités </h2>
    </div>
  </div>
  <a href="https://www.isep.fr/" target="_blank"> <img src="../../images/logo_isep.png" id="LISEP" alt="Logo ISEP" title="Logo ISEP"> </a>
  <img src="../../images/logo-events-IT.png" id="LEVENTS" alt="Logo EVENTS-IT" title="Logo EVENTS-IT"> <!--logo EVENTS-IT-->
  <img src="../../images/TransNoise.png" id="LTransnoise" alt="Logo Transnoise" title="Logo Transnoise"> <!--logo Transnoise-->
  <a href="index.php"><img src="../../images/EchoKey_extrude.png" id="LEchokey" alt="Logo EchoKey" title="Logo EchoKey"></a> <!--logo EchoKey-->
  <li>
    <!--logo déconnexion-->
    <img src="../../images/déconnexion.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()"onclick="deconnexion()">
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
  <script src="../js/espaceuser.js"></script>
  </body>
</html>

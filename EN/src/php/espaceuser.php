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
        <li><a href="analyse.php">Analysis</a></li>
        <li><a href="faq.php">Faq</a></li>
        <li><a href="espaceuser.php">Profile</a></li>
      </ul>
    </nav>

    <div class="header" style="width: 100%; height: 25%; float: left">
      <h1>Welcome to Your Space!</h1>
    </div>

    <div class="main" style="width: 100%; height: 80%; float: left">
      <div class="img1" style="margin-top: 200px">
        <figure>
          <a href="profil.php">
            <img src="../../images/img-profil.png" id="img-profil" />
            <div class="image-text">Profile</div>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img2" style="margin-top: 200px">
        <figure>
          <a href="analyse.php">
            <img src="../../images/img-analyse.png" id="img-analyse" />
            <div class="image-text2">Analysis</div>
          </a>
        </figure>
        <span></span>
      </div>

      <div class="img3" style="margin-top: 200px">
        <figure>
          <a href="forum.php">
            <img src="../../images/img-forum.png" id="img-forum" />
            <div class="image-text3">Forum</div>
          </a>
        </figure>
        <span></span>
      </div>
      <div class="news" style="margin-top: 200px">
        <img src="../../images/img-news.png" id="img-news" />
      </div>
    </div>
    <div class="tab" id="pullTab">
      <h2 style="text-align: center">The Week's News</h2>
      <div class="art1">
        <img
          src="../../images/reseauxsociaux.jpg"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
        Article 1: "The Emergence of Independent Artists in the Music Industry"
        </h3>
        <p style="text-align: left">  
        In the constantly evolving world of music, a significant trend is emerging
        with the growing prominence of independent artists. Thanks to the rise of 
        streaming platforms and social media, musicians can now reach a global 
        audience without the need for major record labels. This increased artistic 
        freedom allows emerging talents to create and share their music authentically, 
        bypassing traditional music industry barriers. The enhanced autonomy of 
        independent artists is opening up exciting new possibilities and redefining 
        the dynamics of the contemporary music industry.
        </p>
        <br />
      </div>
      <div class="art2">
        <img
          src="../../images/operatech.png"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
        Article 2: "The Integration of Technology in Opera Productions"
        </h3>
        <p style="text-align: left">

        Opera, an ancient art form, is reinventing itself in the technological era. 
        Opera productions are increasingly incorporating cutting-edge technologies 
        to create unique visual and auditory experiences. From 3D projections 
        to innovative special effects, operatic stages are transformed, providing 
        audiences with an unprecedented level of immersion. These technological 
        advancements allow opera companies to explore new interpretations of classics 
        while attracting a more diverse audience and renewing interest in this 
        traditional art form.
        </p>
        <br />
      </div>
      <div class="art3">
        <img
          src="../../images/musiqueimmersive.jpg"
          style="width: 40%; height: 40%; float: right"
        />
        <h3 style="color: blueviolet">
        Article 3: "The Revolution of Immersive Music"
        </h3>
        <p style="text-align: left">

        A quiet revolution is shaking the music world with the advent of immersive audio. 
        3D audio technologies and virtual reality headsets are offering a completely new 
        musical experience, placing the listener at the heart of the music. Artists are 
        experimenting with innovative audio production techniques to create pieces that 
        resonate differently depending on the listener's position in virtual space. This 
        trend is transforming how we perceive and appreciate music, pushing the boundaries 
        of creativity and opening new prospects for the future of the music industry.
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

<?php
session_start(); // Start the session at the beginning of the script
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

  <!-- Header manages the top bar of the screen -->
  <header>
    <nav>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analysis</a></li>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="espaceuser.php">Profile</a></li>
      </ul>
    </nav>
    <div class="loupebar"> <input type="text" id="searchInput" placeholder="Search..."> <div class="search"></div></div>
  </header>
  <!-- Body manages the body of the page -->
  <body>
    <!-- The logo at the top left -->
    <div class="header-container">
        <a href="index.php">
            <img src="../../images/EchoKey_extrude.png" id="Logo1" alt="EchoKey Logo" title="EchoKey Logo">
        </a>
        <div class="language-selector">
          <a href="../../../EN/src/php/index.php">English</a> | <a href="../../../FR/src/php/index.php">Français</a>
        </div>
    </div>
    <?php
    if(isset($_SESSION['user_id'])) {
      echo '<p class="welcome-message">Welcome ' . $_SESSION['prenom'] . '!' . '</p>';
    }
    ?>
    <!-- Manages the text in the middle of the page -->
    <div class="content">
      <h1>
        Find
        <br />
        Your <br />
        Voice
      </h1>
      <img src="../../images/Image_index.jpeg" alt="singer" height="300px" />
    </div>
    <div class="content-container">
      <div class="left">
        <h1 class="Echokey">Echokey</h1>
        <p class="paragraphe">
        Many artists lack precise analysis of their performance. Echokey offers an innovative solution by placing state-of-the-art sensors in the biggest Parisian venues such as the Olympia, Opéra Garnier, or the Bataclan. The data collected by our sensors is analyzed, and a graphical report is directly sent to our clients.
        </p>
      </div>
      <div class="right">
        <h1>
          Already more than<br /><span>7,098 people </span><br />trust our expertise
        </h1>
      </div>
    </div>
    <div class="buton">
     
    <?php
    if(isset($_SESSION['user_id'])) {
      echo '<button class="cn" id="scrollButton"><a href="logout.php">Do you wish to log out</a></button>';
    } else {
      // If the user is not logged in, display the login button
      echo '<button class="cn" id="scrollButton"><a href="Connexion.php">Log In!</a></button>';
    }
    ?>
    </button>
    </div>

  <!-- Footer manages the bottom of the page -->
  <img src="../../images/collage.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter"> <!-- Transnoise logo -->

<footer>
  <div class="footer">
  <nav>
    <ul>
      <li><a href="CGU.php" target="_blank">T&Cs</a></li>
      <li><a href="https://www.isep.fr/" target="_blank">Our Investors</a></li>
      <li><a href="faq.php" target="_blank">Contact</a></li>
    </ul>
  </nav>
</div>
</footer>
<script src="../js/index.js"></script>
</body>
</html>

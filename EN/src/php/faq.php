<?php
// Start the session at the beginning of each PHP page
session_start();

// Ensure that the user is logged in before proceeding
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if the user is not logged in
    header("Location: Connexion.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="en"> <!-- Changed language to English -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="../css/faq.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/normalize.css">
    <script src="../js/jquery.min.js"></script>
    
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico">
    <title>TransNoise - EchoKey</title>
</head>
<body>
  <header>
    <nav>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analysis</a></li>
        <li><a href="faq.php">FAQ</a></li> <!-- Changed "Faq" to "FAQ" for consistency -->
        <li><a href="espaceuser.php">Profile</a></li>
      </ul>
    </nav>
    <div class="loupebar"> <input type="text" id="searchInput" placeholder="Search..."> <div class="search"></div></div>
  </header>

  <a href="index.php"><img src="../../images/EchoKey_extrude.png" id="Logo1" alt="EchoKey Logo" title="EchoKey Logo"></a> <!--logo EchoKey-->

  <div class="container"><!-- Search bar -->
    <h2 style="text-align: center; font-size: 60.724px;">Ask your question:</h2>  <!-- Question title -->

    <div class="wrapper"> <!-- Search bar -->
      <div class="searchBar">
        <form id="searchForm">
          <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Ask your question here" value="">
          <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
            <img class="arrow-icon" id="hoverImage" src="../../images/arrow.png" width="30" height="30"/><!--A JavaScript element takes care of detecting mouse hover and loads a grayscale image.-->
          </button>
        </form>
      </div>
    </div>

    <h4 style="text-align: center;"><br>Or check the following questions:</h4> <!-- Generic questions -->
    <div class="accordion">
      <div class="accordion-item">
        <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How does the recording work?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>It's very simple. <br><br>If the venue where the artist performs is equipped with EchoKey™ equipment, and they are logged into their EchoKey™ user account and have started a recording session, their performance is recorded by our equipment and sent directly to their EchoKey™ user session.
            <br><br>If the user has an audio file compatible with EchoKey™, they can upload it directly from the <a href="analyse.php">Analysis</a> page.<br></p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">How does the analysis of a recording work?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>In collaboration with Events-IT™, the TransNoise™ team has developed a brand new, highly efficient technology for its EchoKey™ service.<br><br>
          Indeed, our technology analyzes the audio data of a recording made by our Echokey™ equipment or provided by the user.<br><br>Its powerful algorithm then analyzes the accuracy of the notes in the audio.<br><br>
          This allows the artist to judge their performance precisely and objectively, whether it's vocal or using one or more musical instruments.</p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">How can I compare two recordings?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>It's quite straightforward, actually!<br><br>First, once logged into their EchoKey™ user account, the user has access from their <a href="espaceuser.php">Profile</a> page to various options, including the ability to access their past recordings and/or compare their past performance analyses.
            <br><br>Thus, the user can track the evolution or regression of the accuracy of their performances over time.
            <br><br>Finally, a "global ranking" displays a ranking of the overall accuracy percentage of EchoKey™ service users, allowing users to gauge their accuracy compared to others.
            <br><br>However, this feature should be taken with a grain of salt, as it may involve comparing the performances of a rapper and a percussionist.</p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Can I import my own recording?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>Absolutely!<br><br>Under certain conditions to be met (functionality still under development), any EchoKey™ user logged into their user session can do so from the <a href="analyse.php">Analysis</a> tab, accessible from this link, the menu at the top of this page, or directly from their <a href="espaceuser.php">Profile</a>.
            <br><br>From this page, they can access all their past performances via a sliding panel if they have any or import them, subject to compliance with the conditions defined earlier.</p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">Have another question?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>Do you have a question but didn't find the answer in this FAQ?<br><br>No problem!!!<br><br>Connected to your EchoKey™ user session, you just need to ask your question in the dedicated bar, and an email will be sent to our EchoKey™ team.
            <br><br>From our EchoKey™ offices to Events-IT™, a member of our team will be delighted to respond to your email, and you will receive a response at the email address you provided during your registration.
            <br><br>P.S: Be sure to check your spam... It would be a shame to miss out on the answer to a question when it's just a click away!!!</p>
        </div>
      </div>
    </div>
  </div>

  <img src="../../images/collage.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter"> <!-- TransNoise logo -->
  <li>
    <!--logo déconnexion-->
    <img src="../../images/déconnexion_test.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">
  </li>
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

<script src="../js/faq.js"></script>
</body>
</html>

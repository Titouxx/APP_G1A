<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>TransNoise - EchoKey</title>
    <link rel="stylesheet" href="../css/forum-manel.css" />

    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/espaceuser.css" />
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <script src="../js/jquery.min.js"></script>
  </head>
  <body background="../../images/bgtest2.png">
    <nav>
      <ul class="menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="analyse.html">Analyse</a></li>
        <li><a href="faq.html">Faq</a></li>
        <li><a href="espaceuser.html">Profil</a></li>
      </ul>
    </nav>

    <header>
      <img src="../../images/forum.png" />
    </header>

    <!-- forum section -->
    <div class="forum-section">
      <div class="post-form">
        <h1>...commencer une nouvelle discussion !</h1>
        <input type="text" id="discussionTitle" placeholder="Titre" />
        <textarea id="discussionContent" placeholder="Message"></textarea>
        <input type="text" id="username" placeholder="Votre Username" />
        <button onclick="createDiscussion()">Créer Discussion</button>
      </div>
      <div class="discussion-list" id="discussionList">
        <h1>...ou rejoindre une discussion en cours !</h1>
      </div>
    </div>

    <script src="../js/forum-manel.js"></script>
  </body>
</html>

<?php
// Démarrez la session au début de chaque page PHP
session_start();
// Vérifiez la dernière activité et déconnectez l'utilisateur après 1 heure d'inactivité
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Déconnecter l'utilisateur après 1 heure d'inactivité
    session_unset();
    session_destroy();
}
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="fr">
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
            <li><a href="analyse.php">Analyse</a></li>
            <li><a href="faq.php">Faq</a></li>
            <li><a href="espaceuser.php">Profil</a></li>  
        </ul>
    </nav>
    <div class="loupebar"> <input type="text" id="searchInput" placeholder="Search..."> <div class="search"></div></div>
    </header>

    <img src="../../images/EchoKey_extrude.png" id="Logo1" alt="Logo EchoKey" title="Logo EchoKey"><!--logo EchoKey-->

<div class="container"><!--barre de recherche-->
  <h2 style="text-align: center; font-size: 60.724px;">Posez votre question:</h2>  <!--titre question-->

<div class="wrapper"> <!-- Barre de recherche -->
  <div class="searchBar">
      <form id="searchForm">
        <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Posez votre question ici" value="">
          <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
            <img class="arrow-icon" id="hoverImage" src="../../images/arrow.png" width="30" height="30"/><!--Un élément Javascript s'occupe lui de détecter le survol de la souris et charge une image grisée de celle-ci.-->
          </button>
      </form>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#searchForm').submit(function(event){
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire

      var query = $('#searchQueryInput').val();// Récupérer la valeur du champ de recherche

      // Envoyer la valeur à un fichier PHP pour traitement
      $.ajax({ 
          url: '../php/faq_fonctions.php',
          method: 'POST',
          data: { query: query },
          success: function(response){
    // Traiter la réponse après exécution réussie du fichier PHP
    alert('E-mail envoyé à l\'utilisateur avec succès !');
    console.log(response); // Afficher la réponse dans la console (facultatif)

    // Vérifier si la réponse contient un message de bienvenue
    if (response.welcomeMessage) {
        document.getElementById("welcomeMessage").innerHTML = response.welcomeMessage;
    }
},

          error: function(){
              // Gestion des erreurs
              alert('Erreur lors de l\'envoi de l\'e-mail.');
          }
      });
  });
});
</script>


<h4 style="text-align: center;"><br>Ou consultez les questions suivantes:</h4> <!--questions génériques-->
    <div class="accordion">
      <div class="accordion-item">
        <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Comment fonctionne l'enregistrement ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>C'est très simple. <br><br>Si la salle où l'artiste performe est équipée du matériel EchoKey™, qu'il est connecté a son compte utilisateur et qu'il a lancé une session d'enregistrement, sa performance est enregistrée par notre materiel et directement envoyée sur sa session utilisateur Echokey™.
            <br><br>Si l'utilisateur est lui même en possession d'un fichier audio compatible, il peut l'uploader directement depuis la page d'<a href="analyse.php">Analyse</a>.<br></p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Comment fonctionne l'analyse d'un enregistrement ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>En collaboration avec Events-IT™, l'équipe TransNoise™ a mis au point une toute nouvelle technologie ultra performante au service de son service EchoKey™.<br><br>
          En effet, notre technologie analyse les données audio d'un enregistrement par notre materiel Echokey™ ou fourni par l'utilisateur.<br><br>Son surpuissant algorithme analyse alors la justesse des notes de l'audio.<br><br>
        Cela permet alors a l'artiste de pouvoir juger sa performance de manière précise et objective, qu'elle soit vocale ou à l'aide d'un ou plusieurs instrument(s) de musique.</p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Comment comparer deux enregistrements ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>C'est assez trivial a vrai dire!<br><br>Pour commencer, une fois connecté a son compte utilisateur EchoKey™, l'utilisateur a accès depuis sa page <a href="espaceuser.php">Profil</a> a différentes options dont celle de pouvoir accéder a ses anciens enregistrements et / ou comparer ses anciennes analyses de performances.
            <br><br>Ainsi, l'utilisateur pourra ainsi constater l'évolution ou la regression de la justesse de ses performances au fur et a mesure du temps.
            <br><br>Enfin, un "classement global" affiche un classement du pourcentage de justesse global des utilisateurs du service EchoKey™ et permet aux utilisateurs d'avoir un indicateur de sa justesse par rapport aux autres utilisateurs.
            <br><br>Cette fonctionnalité est cependant a prendre au second degré car l'on peut s'y retrouver a comparer les performances d'un rappeur et d'un percussionniste.</p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Peut-on importer son propre enregistrement ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>Evidemment!<br><br>Sous certaines conditions à respecter (fonctionnalité encore en cours de développement), n'importe que utilisateur d'EchoKey™ connecté a sa session utilisateur peut le faire depuis dans l'onglet <a href="analyse.php">Analyse</a> accessible depuis ce lien, le menu en haut de cette page, ou alors directement depuis son <a href="espaceuser.php">Profil</a>.
            <br><br> Depuis cette page il pourra effectivement accéder via un volet coulissant à toutes ces performances passées s'il en a ou en importer sous couvert du respect des conditions à définir plus tôt évoquées.
          </p>
        </div>
      </div>
      <div class="accordion-item">
        <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">Autre question ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
          <p>Vous avez une question mais vous n'avez pas trouvé la réponse dans cette FAQ?<br><br>Pas de problème!!!<br><br>Connecté à votre session utilisateur, vous n'avez qu'à poser votre question dans la barre dédiée et un mail sera envoyé a notre équipe d'EchoKey™.
            <br><br>De nos bureaux EchoKey™ à Events-IT™, un membre de notre équipe se fera alors un immense plaisir de répondre à votre mail et vous recevrez alors une réponse sur la boite mail que vous nous avez communiquée lors de votre inscription.
            <br><br>P.S: Pensez bien à verifier vos spam... Il serait dommage de passer à coté de la réponse à une question alors que celle-ci se trouve a portée de clic!!!</p>
        </div>
      </div>
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
      <li><a href="CGU.php" id="ga" target="_blank">C.G.U</a></li>
      <li><a href="https://www.isep.fr/" id="ga" target="_blank">Nos investisseurs</a></li>
      <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
    </ul>
  </nav>
</div>
</footer>

  <script src="../js/faq.js"></script>
</body>
</html>
document.addEventListener("DOMContentLoaded", function () {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "login.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    console.log(this.responseText);
    try {
      var response = JSON.parse(this.responseText);
      console.log(response);
      if (response.status === "success") {
        window.location.href = "../php/analyse.php";
      } else {
        window.location.href = "../php/connexion.php";
      }
    } catch (e) {
      console.error("Erreur de parsing JSON : ", e);
    }
  };
});


//footer
// Popup servant à la déconnexion
function deconnexion() {
  var result = confirm("Voulez-vous vraiment vous déconnecter?");
  if (result == true) {
    alert("Merci de votre visite");
    
    // Effectuer une redirection vers le script PHP de déconnexion
    window.location.href = 'logout.php';
  } else {
    // On ferme juste la popup puisqu'on ne se déconnecte pas en cliquant sur annuler
  }
}

// JS Hover bouton déconnexion
function changerImage(etat) {
  var img = document.getElementById("imgdeco");
  if (etat === "survol") {
    img.src = "../../images/déconnexion-hover_test.png"; // Chemin vers l'image au survol
  } else {
    img.src = "../../images/déconnexion_test.png"; // Chemin vers l'image normale
  }
}

  // Récupérer la hauteur du footer
var footerHeight = document.querySelector('.footer').offsetHeight;

// Appliquer la hauteur du footer comme max-height au LogosFooter
var logosFooter = document.getElementById('LogosFooter');
logosFooter.style.maxHeight = footerHeight + 'px';

// Récupérer la hauteur du footer
var footerHeight = document.querySelector('.footer').offsetHeight;

// Appliquer la hauteur du footer comme max-height à l'élément avec l'id "imgdeco"
var imgDeco = document.getElementById('imgdeco');
imgDeco.style.maxHeight = footerHeight + 'px';
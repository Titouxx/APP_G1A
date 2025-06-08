//footer
// Popup servant à la déconnexion
function deconnexion() {
  var result = confirm("Voulez-vous vraiment vous déconnecter?");
  if (result == true) {
    alert("Merci de votre visite");

    // Effectuer une redirection vers le script PHP de déconnexion
    window.location.href = "logout.php";
  } else {
    // On ferme juste la popup puisqu'on ne se déconnecte pas en cliquant sur annuler
  }
}

// JS Hover bouton déconnexion
function changerImage(etat) {
  var img = document.getElementById("imgdeco");
  if (etat === "survol") {
    img.src = "../../images/déconnexion2-hover.png"; // Chemin vers l'image au survol
  } else {
    img.src = "../../images/déconnexion2.png"; // Chemin vers l'image normale
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var footer = document.querySelector(".footer");
  if (footer) {
    var footerHeight = footer.offsetHeight;

    var logosFooter = document.getElementById("LogosFooter");
    if (logosFooter) {
      logosFooter.style.maxHeight = footerHeight + "px";
    }

    var imgDeco = document.getElementById("imgdeco");
    if (imgDeco) {
      imgDeco.style.maxHeight = footerHeight + "px";
    }
  }
});

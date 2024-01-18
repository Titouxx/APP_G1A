// Popup servant à la déconnexion
function deconnexion() {
  var result = confirm("Voulez-vous vraiment vous déconnecter?");
  if (result == true) {
    alert("Merci de votre visite");
    // +Insérer ici le code permettant la déconnexion
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
/* Barre de recherche type CTRL+F */

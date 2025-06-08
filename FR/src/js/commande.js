// Popup servant à la déconnexion
function deconnexion() {
  var result = confirm("Voulez-vous vraiment vous déconnecter?");
  if (result == true) {
    alert("Merci de votre visite");
    window.location.href = "logout.php";
  }
}

// JS Hover bouton déconnexion
function changerImage(etat) {
  var img = document.getElementById("imgdeco");
  if (img) {
    // Vérifie si l'élément existe
    if (etat === "survol") {
      img.src = "../../images/déconnexion2-hover.png";
    } else {
      img.src = "../../images/déconnexion2.png";
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll(".form-reservation");
  const alertDiv = document.getElementById("reservation-alert");

  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      if (!reservationData.peutReserver || reservationData.panierEnCours) {
        e.preventDefault();

        let message = "";
        if (!reservationData.peutReserver) {
          message = "Vous avez déjà réservé un panier cette semaine.";
        } else if (reservationData.panierEnCours) {
          message = `Vous avez déjà un panier en cours de réservation chez ${reservationData.dernierPartenaire}.`;
        }

        // Afficher l'alerte
        alertDiv.textContent = message;
        alertDiv.classList.remove("alert-hidden");
        alertDiv.classList.add("alert-visible");

        // Masquer après 3 secondes
        setTimeout(() => {
          alertDiv.classList.remove("alert-visible");
          alertDiv.classList.add("alert-hidden");
        }, 3000);
      }
    });
  });
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

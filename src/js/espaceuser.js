const tab = document.getElementById("pullTab");
const image = document.getElementById("img-news");
const content = document.querySelector(".news");

let isActive = false;

image.addEventListener("click", (event) => {
  isActive = !isActive;
  if (isActive) {
    tab.classList.add("active");
  } else {
    tab.classList.remove("active");
  }
  event.stopPropagation(); // Prevents the click from propagating to the document
});

// Hide tab when clicking outside of the content area or image
document.addEventListener("click", (event) => {
  const isClickInsideContent = content.contains(event.target);
  if (!isClickInsideContent && isActive) {
    tab.classList.remove("active");
    isActive = false;
  }
});

// Prevent tab from hiding when clicking on the tab itself
tab.addEventListener("click", (event) => {
  event.stopPropagation();
});
//popup servant a la deconnexion
function deconnexion() {
  var result = confirm("Voulez-vous vraiment vous déconnecter?");
  if (result == true) {
    alert("Merci de votre visite");
    //+Insérer ici code permettant la déconnexion
  } else {
    //On ferme juste la popup puisqu'on ne se deconnecte pas en cliquant sur annuler
  }
}

//JS Hover bouton déconnexion
function changerImage(etat) {
  var img = document.getElementById("imgdeco");
  if (etat === "survol") {
    img.src = "../../images/déconnexion-hover.png"; // Chemin vers l'image au survol
  } else {
    img.src = "../../images/déconnexion.png"; // Chemin vers l'image normale
  }
}

var container = document.getElementById("image1");
var text = document.getElementById("imageText");

container.addEventListener("mouseover", function () {
  text.style.display = "block";
});

container.addEventListener("mouseout", function () {
  text.style.display = "none";
});

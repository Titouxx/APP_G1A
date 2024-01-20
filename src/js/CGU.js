/* Barre de recherche type CTRL+F */
// Code pour la recherche avec surlignage
document.getElementById('searchInput').addEventListener('input', function() {
    var searchValue = this.value.toLowerCase();
    var elementsToSearch = document.querySelectorAll('.menu a, footer a, .accordion-title, p, h1, h2, h3, h4, h5, h6');
  
    elementsToSearch.forEach(function(element) {
      var originalText = element.getAttribute('data-original-text');
      if (!originalText) {
        originalText = element.textContent;
        element.setAttribute('data-original-text', originalText);
      }
  
      var elementText = originalText;
  
      var regex = new RegExp(searchValue, 'gi');
      var highlightedText = elementText.replace(regex, match => `<span class="highlight">${match}</span>`);
    
      element.innerHTML = highlightedText;
    });
  });
  
  // Code pour restaurer le texte d'origine et vider la barre de recherche
  document.getElementById('searchInput').addEventListener('blur', function() {
    var elementsToRestore = document.querySelectorAll('.menu a, footer a, .accordion-title, p, h1, h2, h3, h4, h5, h6');
  
    elementsToRestore.forEach(function(element) {
      var originalText = element.getAttribute('data-original-text');
      if (originalText) {
        element.innerHTML = originalText;
      }
    });
  
    // Réinitialise la barre de recherche à une chaîne vide
    this.value = '';
  });
  
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
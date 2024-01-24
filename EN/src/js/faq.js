// Sélection de tous les éléments .accordion button
const items = document.querySelectorAll(".accordion button");

// Fonction pour basculer l'état d'expansion de l'accordéon
function toggleAccordion() {
  // Récupère la valeur de l'attribut aria-expanded de l'élément actuel
  const itemToggle = this.getAttribute('aria-expanded');

  // Réinitialise tous les éléments à aria-expanded='false'
  items.forEach(item => {
    item.setAttribute('aria-expanded', 'false');
  });

  // Si l'élément actuel est fermé ou n'a pas d'état défini, le marque comme ouvert, sinon le ferme
  if (itemToggle === 'false' || itemToggle === null) {
    this.setAttribute('aria-expanded', 'true');
  } else {
    this.setAttribute('aria-expanded', 'false');
  }
}

// Ajoute un écouteur d'événement pour chaque élément, déclenchant la fonction toggleAccordion lors d'un clic
items.forEach(item => item.addEventListener('click', toggleAccordion));

const arrowIcon = document.getElementById('hoverImage');

arrowIcon.addEventListener('mouseover', function() {
  this.setAttribute('src', '../../images/arrow_hover.png'); // Utilisez src pour changer l'image
});

arrowIcon.addEventListener('mouseout', function() {
  this.setAttribute('src', '../../images/arrow.png'); // L'image initiale
});


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
  var result = confirm("Do you really wish to disconnect?");
  if (result == true) {
    alert("See you soon !");
    
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


$(document).ready(function(){
  // Déclarez la variable query en dehors du gestionnaire de soumission
  var query;

  $('#searchForm').submit(function(event){
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire

      // Utilisez la variable déjà déclarée à l'extérieur
      query = $('#searchQueryInput').val(); // Récupérer la valeur du champ de recherche

      // Vérifier si la barre de recherche est vide
      if (query.trim() === "") {
          alert("Veuillez saisir votre question avant d'envoyer l'e-mail.");
          return;
      }

      // Envoyer la valeur à un fichier PHP pour traitement
      $.ajax({ 
          url: 'faq_fonctions.php',
          method: 'POST',
          data: { searchQueryInput: query },
          success: function(response){
              // Traiter la réponse après exécution réussie du fichier PHP
              alert('E-mail envoyé à l\'utilisateur avec succès !');
              console.log(response); // Afficher la réponse dans la console (facultatif)
          },
          error: function(xhr, status, error) {
              console.error("Erreur Ajax :", status, error); // Gestion des erreurs
          }
      });
  });
});

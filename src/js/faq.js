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





const arrowIcon = document.getElementById('hoverImage');// Hover pour l'image

arrowIcon.addEventListener('mouseover', function() {
  this.setAttribute('href', '../../images/arrow_hover.png'); //URL de l'image au survol
});

arrowIcon.addEventListener('mouseout', function() {
  this.setAttribute('href', '../../images/arrow.png'); // L'image initiale
});



/* Barre de recherche type CTRL+F */
document.getElementById('searchInput').addEventListener('input', function() {
  var searchValue = this.value.toLowerCase();
  var elementsToSearch = document.querySelectorAll('.menu a, footer a, .accordion-title, p, h1, h2, h3, h4, h5, h6');//Tout ce qui est sélectionné par le code

  elementsToSearch.forEach(function(element) {
    var elementText = element.textContent.toLowerCase();

    var regex = new RegExp(searchValue, 'gi');
    var highlightedText = elementText.replace(regex, match => `<span class="highlight">${match}</span>`);//surligne les caractères
    element.innerHTML = highlightedText;
  });
});


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


//JS Footer
var footerHeight = document.querySelector('.footer').offsetHeight;// Récupérer la hauteur du footer

var logosFooter = document.getElementById('LogosFooter');// Appliquer la hauteur du footer comme max-height au LogosFooter
logosFooter.style.maxHeight = footerHeight + 'px';

var footerHeight = document.querySelector('.footer').offsetHeight;// Récupérer la hauteur du footer
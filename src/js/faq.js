
const items = document.querySelectorAll(".accordion button"); //js questions génériques

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  
  
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));

const arrowIcon = document.getElementById('hoverImage');// Hover pour l'image

arrowIcon.addEventListener('mouseover', function() {
  this.setAttribute('href', '../../images/arrow_hover.png'); //URL de l'image au survol
});

arrowIcon.addEventListener('mouseout', function() {
  this.setAttribute('href', '../../images/arrow.png'); // L'image initiale
});




document.getElementById('searchInput').addEventListener('input', function() {
  var searchValue = this.value.toLowerCase();
  var elementsToSearch = document.querySelectorAll('.menu a, footer a, .accordion-title, p, h1, h2, h3, h4, h5, h6, #searchQuerySubmit');

  elementsToSearch.forEach(function(element) {
    var elementText = element.textContent.toLowerCase();

    var regex = new RegExp(searchValue, 'gi');
    var highlightedText = elementText.replace(regex, match => `<span class="highlight">${match}</span>`);
    element.innerHTML = highlightedText;
  });
});


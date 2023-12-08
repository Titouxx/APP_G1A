
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



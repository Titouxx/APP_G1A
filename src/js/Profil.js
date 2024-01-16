function showSection(sectionId) {
  const sections = document.querySelectorAll(".section.profile");
  sections.forEach((section) => {
    if (section.id === sectionId) {
      section.style.display = "block";
    } else {
      section.style.display = "none";
    }
  });

  // Mettre à jour l'état du bouton "Modifier"
  updateModifierButtonState(sectionId);
}

function updateModifierButtonState(sectionId) {
  var modifierButton = document.getElementById("Modifier");

  // Afficher le bouton "Modifier" uniquement si une section est sélectionnée
  modifierButton.style.display = sectionId ? "inline-block" : "none";

  // Masquer le bouton "Enregistrer" lors de la sélection d'une nouvelle section
  document.getElementById("Enregistrer").style.display = "none";
}

function activerEdition() {
  var champsEditable = document.querySelectorAll(
    "#coordonnees input[disabled]"
  );
  champsEditable.forEach(function (champ) {
    champ.removeAttribute("disabled");
  });

  // Afficher le bouton "Enregistrer" et masquer le bouton "Modifier"
  document.getElementById("Enregistrer").style.display = "inline-block";
  document.getElementById("Modifier").style.display = "none";
}

function showSection(sectionId) {
  const sections = document.querySelectorAll(".section.profile");
  sections.forEach((section) => {
    if (section.id === sectionId) {
      section.style.display = "block";
    } else {
      section.style.display = "none";
    }
  });

  // Mettre à jour l'état du bouton "Modifier"
  updateModifierButtonState(sectionId);
}

function updateModifierButtonState(sectionId) {
  var modifierButton = document.getElementById("Modifier");

  // Afficher le bouton "Modifier" uniquement si une section est sélectionnée
  modifierButton.style.display = sectionId ? "inline-block" : "none";

  // Masquer le bouton "Enregistrer" lors de la sélection d'une nouvelle section
  document.getElementById("Enregistrer").style.display = "none";
}

function activerEdition() {
  var champsEditable = document.querySelectorAll(
    "#coordonnees input[disabled]"
  );
  champsEditable.forEach(function (champ) {
    champ.removeAttribute("disabled");
  });

  // Afficher le bouton "Enregistrer" et masquer le bouton "Modifier"
  document.getElementById("Enregistrer").style.display = "inline-block";
  document.getElementById("Modifier").style.display = "none";
}

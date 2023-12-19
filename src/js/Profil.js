function showSection(sectionId) {
  const sections = document.querySelectorAll(".section.profile");
  sections.forEach((section) => {
    if (section.id === sectionId) {
      section.style.display = "block";
    } else {
      section.style.display = "none";
    }
  });
}

function activerEdition() {
  var champsEditable = document.querySelectorAll(
    "#coordonnees input[readonly]"
  );
  champsEditable.forEach(function (champ) {
    champ.removeAttribute("readonly");
  });

  // Afficher le bouton "Enregistrer" et masquer le bouton "Modifier"
  document.getElementById("Enregistrer").style.display = "inline-block";
  document.getElementById("Modifier").style.display = "none";
}

function enregistrerEdition() {
  var champsEditable = document.querySelectorAll("#coordonnees input");
  champsEditable.forEach(function (champ) {
    champ.setAttribute("readonly", "true");
  });

  // Afficher le bouton "Modifier" et masquer le bouton "Enregistrer"
  document.getElementById("Modifier").style.display = "inline-block";
  document.getElementById("Enregistrer").style.display = "none";
}

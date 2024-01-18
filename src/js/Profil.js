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

function enregistrerEdition() {
  var first_name = document.getElementById("first_name").value;
  var last_name = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var adresse = document.getElementById("adresse").value;
  var city = document.getElementById("city").value;

  document.getElementById("Enregistrer").style.display = "none";
  document.getElementById("Modifier").style.display = "inline-block";
  // Send the modified data to the PHP script using AJAX
  $.ajax({
    url: "update_profile.php",
    type: "POST",
    data: {
      first_name: first_name,
      last_name: last_name,
      email: email,
      phone: phone,
      adresse: adresse,
      city: city,
    },
    success: function (response) {
      // Handle the response from the PHP script
      if (response === "success") {
        alert("Profile updated successfully!");
      } else {
        alert("Failed to update profile.");
      }
    },
  });
}

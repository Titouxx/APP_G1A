function updateModifierButtonState(sectionId) {
  var modifierButton = document.getElementById("Modifier");

  // Afficher le bouton "Modifier" uniquement si une section est sélectionnée
  modifierButton.style.display = sectionId ? "inline-block" : "none";

  // Masquer le bouton "Enregistrer" lors de la sélection d'une nouvelle section
  document.getElementById("Enregistrer").style.display = "none";
}

function activerEdition() {
  var champsEditable = document.querySelectorAll(
    "#coordonnees input[disabled], #parametres input[disabled]"
  );
  champsEditable.forEach(function (champ) {
    champ.removeAttribute("disabled");
  });

  // Afficher le bouton "Enregistrer" et masquer le bouton "Modifier"
  document.getElementById("Enregistrer").style.display = "inline-block";
  document.getElementById("Modifier").style.display = "none";
  document.getElementById("Enregistrer").style.marginLeft = "65px";
}

function desactiverChamps() {
  var champsCoordonnees = document.querySelectorAll(
    "#coordonnees input:not([disabled]), #parametres input:not([disabled])"
  );
  champsCoordonnees.forEach(function (champ) {
    champ.setAttribute("disabled", true);
  });
  document.getElementById("Modifier").style.display = "inline-block";
  document.getElementById("Enregistrer").style.display = "none";
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

  // Mettre à jour l'état du bouton Modifier
  updateModifierButtonState(sectionId);
}

function enregistrerEdition() {
  var first_name = document.getElementById("first_name").value;
  var last_name = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var adresse = document.getElementById("adresse").value;
  var city = document.getElementById("city").value;
  var password = document.getElementById("password").value;
  desactiverChamps();

  // Enregistrer les modifications dans la base de données
  var request = $.ajax({
    url: "update_profile.php",
    type: "POST",
    data: {
      first_name: first_name,
      last_name: last_name,
      email: email,
      phone: phone,
      adresse: adresse,
      city: city,
      password: password,
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        alert("Profile updated successfully!");
      } else {
        alert("Failed to update profile.");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });

  $.ajax({
    url: "check_user.php",
    type: "POST",
    success: function (response) {
      var responseObject = JSON.parse(response);
      if (responseObject.logged_in) {
        // L'utilisateur est connecté, son ID est responseObject.user_id
      } else {
        // L'utilisateur n'est pas connecté
      }
    },
  });
}

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
  dataType: "json",
  success: function (response) {
    if (response.status === "success") {
      alert("Profile updated successfully!");
    } else {
      alert("Failed to update profile.");
    }
  },
  error: function (jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
  },
});

$.ajax({
  url: "check_user.php",
  type: "POST",
  success: function (response) {
    var responseObject = JSON.parse(response);
    if (responseObject.logged_in) {
      // L'utilisateur est connecté, son ID est responseObject.user_id
    } else {
      // L'utilisateur n'est pas connecté
    }
  },
});

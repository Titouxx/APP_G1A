function updateModifierButtonState(sectionId) {
  var modifierButton = document.getElementById("Modifier");
  var majButton = document.getElementById("Maj"); // Utilisez "Maj" à la place de "MettreAJour"
  var annulerEditionButton = document.getElementById("AnnulerEdition");

  // Afficher le bouton "Modifier" uniquement si la section "coordonnees" est sélectionnée
  modifierButton.style.display =
    sectionId === "coordonnees" ? "inline" : "none";

  // Afficher le bouton "Mettre à jour" uniquement si la section "parametres" est sélectionnée
  majButton.style.display = sectionId === "parametres" ? "inline" : "none";

  // Masquer le bouton "Enregistrer" lors de la sélection d'une nouvelle section
  document.getElementById("Enregistrer").style.display = "none";
  document.getElementById("AnnulerEdition").style.display = "none";
}

function activerEdition() {
  var champsEditable = document.querySelectorAll(
    "#coordonnees input[disabled]:not(#first_name):not(#last_name):not(#email)"
  );
  console.log(champsEditable); // Afficher les champs dans la console pour déboguer

  champsEditable.forEach(function (champ) {
    champ.removeAttribute("disabled");
  });

  // Afficher le bouton "Enregistrer" et masquer le bouton "Modifier"
  document.getElementById("Enregistrer").style.display = "inline";
  document.getElementById("AnnulerEdition").style.display = "inline";
  document.getElementById("Modifier").style.display = "none";
}

function desactiverChampsCoordonnees() {
  var champsCoordonnees = document.querySelectorAll(
    "#coordonnees input:not([disabled])"
  );
  champsCoordonnees.forEach(function (champ) {
    champ.setAttribute("disabled", true);
  });

  document.getElementById("Modifier").style.display = "inline";
  document.getElementById("Enregistrer").style.display = "none";
  document.getElementById("AnnulerEdition").style.display = "none";
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
  var phone = document.getElementById("phone").value;
  var adresse = document.getElementById("adresse").value;
  var city = document.getElementById("city").value;
  desactiverChampsCoordonnees();

  // Enregistrer les modifications dans la base de données
  var request = $.ajax({
    url: "update_profile.php",
    type: "POST",
    data: {
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
}
function annulerEdition() {
  desactiverChampsCoordonnees();
}

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

function majPassword() {
  console.log("Attempting to update password...");
  // Récupérer l'ancien mot de passe depuis le champ du formulaire
  var oldPassword = document.getElementById("current_password").value;
  var newPassword = document.getElementById("new_password").value;
  var confirmPassword = document.getElementById("confirm_password").value;

  // Vérifier si les nouveaux mots de passe sont identiques
  if (newPassword !== confirmPassword) {
    alert("Les nouveaux mots de passe ne correspondent pas !");
    return;
  }

  // Créer un objet avec les données à envoyer
  var requestData = {
    oldPassword: oldPassword,
    newPassword: newPassword,
  };
  console.log("Request Data:", requestData);

  // Effectuer la requête Ajax pour mettre à jour le mot de passe
  $.ajax({
    url: "update_password.php",
    type: "POST",
    data: requestData,
    dataType: "json",
    success: function (data) {
      console.log(data); // Affiche la réponse brute
      if (data.status === "success") {
        // Mot de passe correct, effectuer les actions nécessaires
        alert("Mot de passe mis à jour avec succès !");
      } else {
        // Mot de passe incorrect, afficher un message d'erreur
        alert("Échec de la mise à jour du mot de passe : " + data.message);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      // Gérer les erreurs de la requête
      console.log(jqXHR.responseText); // Afficher le message d'erreur dans la console
      console.error(
        "Erreur de requête Ajax : " + textStatus + ", " + errorThrown
      );
    },
  });
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
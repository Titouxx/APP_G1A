document.getElementById("registerBtn").addEventListener("click", function () {
  document.getElementById("loginWrapper").style.display = "none";
  document.getElementById("registerWrapper").style.display = "block";
});

document.getElementById("Sign up").addEventListener("click", function () {
  document.getElementById("loginWrapper").style.display = "block";
  document.getElementById("registerWrapper").style.display = "none";
});

document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    var username = document.getElementById("loginUsername").value;
    var password = document.getElementById("loginPassword").value;

    if (!username || !password) {
      alert("Veuillez remplir tous les champs.");
      event.preventDefault(); // Empêche la soumission du formulaire
    } else {
      // Ajoutez ici le code de validation et de traitement pour le formulaire de connexion
    }
  });
document
  .getElementById("registerForm")
  .addEventListener("submit", function (event) {
    var registerUsername = document.getElementById("registerUsername").value;
    var registerPassword = document.getElementById("registerPassword").value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Vérifier du format de l'adresse email
    if (!emailRegex.test(registerUsername)) {
      alert(
        "Veuillez saisir une adresse email valide comme nom d'utilisateur."
      );
      event.preventDefault(); // Empêche la soumission du formulaire
      return;
    }

    //Vérifier si l'espace est remplie
    if (!registerUsername || !registerPassword) {
      alert("Veuillez remplir tous les champs.");
      event.preventDefault(); // Empêche la soumission du formulaire
    } else {
      // Ajoutez ici le code de validation et de traitement pour le formulaire d'inscription
    }
  });

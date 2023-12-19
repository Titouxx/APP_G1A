document.addEventListener("DOMContentLoaded", function () {
  // Toggle to registration form
  document.getElementById("registerBtn").addEventListener("click", function () {
    document.getElementById("loginWrapper").style.display = "none";
    document.getElementById("registerWrapper").style.display = "block";
  });

  // Toggle to login form
  document.getElementById("loginBtn").addEventListener("click", function () {
    document.getElementById("loginWrapper").style.display = "block";
    document.getElementById("registerWrapper").style.display = "none";
  });
});

document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    var email = document.getElementById("loginEmail").value;
    var password = document.getElementById("loginPassword").value;

    if (!email || !password) {
      alert("Veuillez remplir tous les champs.");
      event.preventDefault(); // Empêche la soumission du formulaire
    } else {
      // Ajoutez ici le code de validation et de traitement pour le formulaire de connexion
    }
  });
document
  .getElementById("registerForm")
  .addEventListener("submit", function (event) {
    var registerEmail = document.getElementById("registerEmail").value;
    var registerPassword = document.getElementById("registerPassword").value;
    var repeatPasseword = document.getElementById("repeatPassword").value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Vérifier du format de l'adresse email
    if (!emailRegex.test(registerEmail)) {
      alert("Veuillez saisir une adresse email valide.");
      event.preventDefault(); // Empêche la soumission du formulaire
      return;
    }

    //Vérifier si l'espace est remplie
    if (!registerEmail || !registerPassword) {
      alert("Veuillez remplir tous les champs.");
      event.preventDefault(); // Empêche la soumission du formulaire
    } else {
      // Ajoutez ici le code de validation et de traitement pour le formulaire d'inscription
    }
  });

  document.getElementById("registerForm").addEventListener("submit", function (event) {
    event.preventDefault();

    var registerEmail = document.getElementById("registerEmail").value;
    var registerPassword = document.getElementById("registerPassword").value;

    // Envoi des données au serveur PHP pour inscription
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "database.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du serveur (peut inclure un message de confirmation ou d'erreur)
            var response = xhr.responseText;
            // Mettez ici le code pour traiter la réponse
        }
    };
    xhr.send("action=register&email=" + registerEmail + "&password=" + registerPassword);
});

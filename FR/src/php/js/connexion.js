document.addEventListener("DOMContentLoaded", function () {
  // Bascule entre les formulaires
  var registerBtn = document.getElementById("registerBtn");
  var loginBtn = document.getElementById("loginBtn");
  var loginWrapper = document.getElementById("loginWrapper");
  var registerWrapper = document.getElementById("registerWrapper");

  registerBtn.addEventListener("click", function () {
    loginWrapper.style.display = "none";
    registerWrapper.style.display = "block";
  });

  loginBtn.addEventListener("click", function () {
    loginWrapper.style.display = "block";
    registerWrapper.style.display = "none";
  });

  // Formulaire de connexion
  var loginForm = document.getElementById("loginForm");
  loginForm.addEventListener("submit", function (event) {
    event.preventDefault();
    var email = document.getElementById("loginEmail").value;
    var password = document.getElementById("loginPassword").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      console.log(this.responseText);
      try {
        var response = JSON.parse(this.responseText);
        console.log(response);
        if (response.status === "success") {
          window.location.href = "../index.php";
        } else {
          alert(response.message || "Une erreur est survenue");
        }
      } catch (e) {
        console.error("Erreur de parsing JSON : ", e);
      }
    };

    // Envoyer le mot de passe en clair dans la requête (non recommandé en production)
    xhr.send("loginEmail=" + encodeURIComponent(email) + "&loginPassword=" + encodeURIComponent(password));
  });

// Formulaire d'enregistrement
var registerForm = document.getElementById("registerForm");
registerForm.addEventListener("submit", function (event) {
  event.preventDefault();
  var firstNameField = document.getElementById("registerFirstName").value;
  var lastNameField = document.getElementById("registerLastName").value;
  var emailField = document.getElementById("registerEmail");
  var password = document.getElementById("registerPassword").value;
  var repeatPassword = document.getElementById("RepeatPassword").value;

    // Vérifiez si les mots de passe correspondent
    if (password !== repeatPassword) {
      alert("Les mots de passe ne correspondent pas.");
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      console.log(this.responseText);
      try {
        var response = JSON.parse(this.responseText);
        console.log(response);
        if (response.status === "success") {
          window.location.href = "../index.php";
        } else if (response.status === "error" && response.message === "email_exists") {
          emailField.style.color = 'red';
          alert("Cet email est déjà utilisé.");
        } else {
          emailField.style.color = 'initial'; 
          alert(response.message || "Une erreur est survenue lors de l'enregistrement");
        }
      } catch (e) {
        console.error("Erreur de parsing JSON : ", e);
      }
    };

    xhr.send(
      "registerFirstName=" + encodeURIComponent(firstNameField) +
      "&registerLastName=" + encodeURIComponent(lastNameField) +
      "&registerEmail=" + encodeURIComponent(emailField.value) + 
      "&registerPassword=" + encodeURIComponent(password) +
      "&RepeatPassword=" + encodeURIComponent(repeatPassword)
    );
  });
});

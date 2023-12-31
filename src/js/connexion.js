
document.addEventListener("DOMContentLoaded", function () {
    // Bascule entre les formulaires
    document.getElementById("registerBtn").addEventListener("click", function () {
        document.getElementById("loginWrapper").style.display = "none";
        document.getElementById("registerWrapper").style.display = "block";
    });
  
    document.getElementById("loginBtn").addEventListener("click", function () {
        document.getElementById("loginWrapper").style.display = "block";
        document.getElementById("registerWrapper").style.display = "none";
    });
  });
  document.getElementById("loginForm").addEventListener("submit", function(event) {
      event.preventDefault();
      var email = document.getElementById("loginEmail").value;
      var password = document.getElementById("loginPassword").value;
  
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "login.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function() {
          console.log(this.responseText); // Afficher la réponse brute du serveur
          try {
  
              var response = JSON.parse(this.responseText);
              console.log(response); // Afficher l'objet réponse
              if (response.status === "success") {
  
                  window.location.href = "../php/index.php"; // Redirection vers une nouvelle page
  
              } else {
                  // Afficher le message d'erreur
                  alert(response.message || "Une erreur est survenue");
              }
          } catch (e){
              console.error("Erreur de parsing JSON: ", e);
          }
      }   
      xhr.send("loginEmail=" + encodeURIComponent(email) + "&loginPassword=" + encodeURIComponent(password));
  });
  document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();
    var emailField = document.getElementById("registerEmail");
    var password = document.getElementById("registerPassword").value;
    var repeatPassword = document.getElementById("RepeatPassword").value;
  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        console.log(this.responseText); // Afficher la réponse brute du serveur
        try {
            var response = JSON.parse(this.responseText);
            console.log(response); // Afficher l'objet réponse
            if (response.status === "success") {
                window.location.href = "../php/index.php"; // Redirection
            } else if (response.status === "error" && response.message === "email_exists") {
                // Afficher le champ email en rouge
                emailField.style.color = 'red';
                alert("Cet email est déjà utilisé.");
            } else {
                // Réinitialiser la couleur du champ email
                emailField.style.color = 'initial';
                alert(response.message || "Une erreur est survenue lors de l'enregistrement");
            }
        } catch (e) {
            console.error("Erreur de parsing JSON: ", e);
        }
    };
    xhr.send("registerEmail=" + encodeURIComponent(emailField.value) + "&registerPassword=" + encodeURIComponent(password) + "&RepeatPassword=" + encodeURIComponent(repeatPassword));
  });
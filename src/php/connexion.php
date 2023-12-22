<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connexion.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body background="../../images/background.png">

    
    <!--Formulaire de connexion-->
    <div class="wrapper" id="loginWrapper">
      <form id="loginForm" action="login.php" method="post">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" id="loginEmail" name="loginEmail" placeholder="Email" required /><i
            class="bx bxs-user"
          ></i>
        </div>
        <div class="input-box">
          <input
            type="password"
            id="loginPassword"
            name="loginPassword"
            placeholder="Password"
            required
          /><i class="bx bxs-lock-alt"></i>
        </div>

        <div class="remember-forgot">
          <label><input type="checkbox" /> Remember me</label>
          <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn">Login</button>
        <p>Don't have an account?</p>
        <button type="button" id="registerBtn" class="btn">Register</button>
      </form>
    </div>


    <div class="wrapper2" id="registerWrapper" style="display: none">
      <form id="registerForm" action="register.php" method="post">
        <h1>Register</h1>
        <div class="input-box">
          <input
            type="text"
            id="registerEmail"
            name="registerEmail"
            placeholder="Email"
            required
          /><i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input
            type="password"
            id="registerPassword"
            name="registerPassword"
            placeholder="Password"
            required
          /><i class="bx bxs-lock-alt"></i>
        </div>
        <div class="input-box">
          <input
            type="password"
            id="RepeatPassword"
            name="RepeatPassword"
            placeholder="Repeat Password"
            required
          /><i class="bx bxs-lock-alt"></i>
        </div>

        <button type="submit" class="btn">Register</button>
        <p>Already have an account?</p>
        <button type="button" id="loginBtn" class="btn">Sign in</button>
      </form>
    </div>
    <script>
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
            var email = document.getElementById("registerEmail").value;
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

                        window.location.href = "../php/index.php"; // Redirection vers la même page que "login"

                    } else {
                        alert(response.message || "Une erreur est survenue lors de l'enregistrement");
                    }
                } catch (e) {
                    console.error("Erreur de parsing JSON: ", e);
                }
            };
            xhr.send("registerEmail=" + encodeURIComponent(email) + "&registerPassword=" + encodeURIComponent(password) + "&RepeatPassword=" + encodeURIComponent(repeatPassword));
        });

    </script>
  </body>
</html>


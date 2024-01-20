document.addEventListener("DOMContentLoaded", function () {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "login.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    console.log(this.responseText);
    try {
      var response = JSON.parse(this.responseText);
      console.log(response);
      if (response.status === "success") {
        window.location.href = "../php/analyse.php";
      } else {
        window.location.href = "../php/connexion.php";
      }
    } catch (e) {
      console.error("Erreur de parsing JSON : ", e);
    }
  };
});

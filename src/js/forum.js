document.addEventListener("DOMContentLoaded", function () {
  const messageForm = document.getElementById("messageForm");
  const postsSection = document.getElementById("posts");

  // Simule l'identifiant de session (vous devez implémenter cela côté serveur)
  const sessionUsername = "utilisateur1";

  // Vérifie si l'utilisateur est connecté
  if (!isUserLoggedIn()) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    window.location.href = "Connexion.html";
  }

  messageForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const usernameInput = document.getElementById("username");
    const message = document.getElementById("message").value;

    // Vérifie si l'identifiant de session correspond à l'identifiant saisi
    if (usernameInput.value === sessionUsername && message) {
      // Créer un nouvel élément de message
      const post = document.createElement("div");
      post.className = "post";
      post.innerHTML = `<strong>${sessionUsername}:</strong> ${message}`;

      // Ajouter le message à la section des messages
      postsSection.appendChild(post);

      // Effacer le formulaire
      messageForm.reset();
    } else {
      // Gérer le cas où l'identifiant de session ne correspond pas
      alert("Identifiant de session incorrect ou message vide");
    }
  });

  // Fonction de simulation de la connexion de l'utilisateur (à remplacer par une vérification côté serveur)
  function isUserLoggedIn() {
    // Implémentez la logique de vérification côté serveur
    // Pour cet exemple, renvoyons simplement true si la session existe
    return true;
  }
});

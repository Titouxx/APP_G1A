document.addEventListener("DOMContentLoaded", function () {
  const messageForm = document.getElementById("messageForm");
  const postsSection = document.getElementById("posts");

  messageForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const message = document.getElementById("message").value;

    if (username && message) {
      // Créer un nouvel élément de message
      const post = document.createElement("div");
      post.className = "post";
      post.innerHTML = `<strong>${username}:</strong> ${message}`;

      // Ajouter le message à la section des messages
      postsSection.appendChild(post);

      // Effacer le formulaire
      messageForm.reset();
    }
  });
});

// Popup pour la déconnexion
function deconnexion() {
  const result = confirm("Voulez-vous vraiment vous déconnecter ?");
  if (result) {
    alert("Merci de votre visite");
    window.location.href = 'logout.php';
  }
}

// Appliquer la hauteur du footer comme max-height au logo et à imgdeco si présents
document.addEventListener("DOMContentLoaded", function () {
  const footer = document.querySelector('.footer');
  const footerHeight = footer ? footer.offsetHeight : 0;

  const logosFooter = document.getElementById('LogosFooter');
  if (logosFooter) {
    logosFooter.style.maxHeight = footerHeight + 'px';
  }

  const imgDeco = document.getElementById('imgdeco');
  if (imgDeco) {
    imgDeco.style.maxHeight = footerHeight + 'px';

    // Optionnel : ajout du clic de déconnexion ici
    imgDeco.addEventListener('click', deconnexion);
  }
});

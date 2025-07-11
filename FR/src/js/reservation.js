document.addEventListener("DOMContentLoaded", function () {
  // Gestion des confirmations
  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function (e) {
      const button = e.submitter;

      if (button.name === "annuler") {
        if (!confirm("Annuler cette réservation ?")) {
          e.preventDefault();
        }
      } else if (button.name === "confirmer") {
        if (!confirm("Confirmer cette réservation ?")) {
          e.preventDefault();
        }
      } else if (button.name === "archiver") {
        if (
          !confirm(
            "Attention à ne pas archiver la réservation avant d'avoir présenté le QR code."
          )
        ) {
          e.preventDefault();
        }
      }
    });
  });
});

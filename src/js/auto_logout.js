let logoutTimer;

function resetLogoutTimer() {
    if (logoutTimer) clearTimeout(logoutTimer);
    logoutTimer = setTimeout(() => {
        navigator.sendBeacon('logout.php');
    }, 3600000); // 1 heure
}

// Écouter les événements d'activité
window.onload = resetLogoutTimer;
document.onmousemove = resetLogoutTimer;
document.onkeypress = resetLogoutTimer;

// Code existant pour la déconnexion à la fermeture
window.onbeforeunload = function() {
    navigator.sendBeacon('logout.php');
};
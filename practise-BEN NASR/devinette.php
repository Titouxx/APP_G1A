<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Ajoute du CSS pour masquer la solution par défaut */
        #solution {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <form action="controlleur.php" method="POST">
        <pre>
            <p>Séléctionnez une devinette :</p>
        <select name="devinette" id="devinette">
            <option value="1">Devinette 1</option>
            <option value="2">Devinette 2</option>
            <option value="3">Devinette 3</option>
        </select>
        <input type="submit" value="Voir la devinette"></input> 
        <br>
        <p id="devinette" onmouseover="changerCouleur(this)" onmouseout="reinitialiserCouleur(this)">
        <?php
            session_start();
            if(isset($_SESSION["texte"])){
                echo $_SESSION["titre"] . " : " . $_SESSION["texte"];
            }

            session_destroy();
        ?>  

<script>
    function soumettre() {
    var confirmation = window.confirm("Êtes-vous sûrs de vouloir voir la solution ?");
    if (confirmation) {
                // Si l'utilisateur clique sur "OK", affiche la solution

                document.getElementById("solution").style.visibility = "visible";
            } else {
                // Si l'utilisateur clique sur "Annuler", ne faites rien ou effectuez d'autres actions si nécessaire
                alert("Soumission de candidature annulée.");
                document.getElementById("solution").style.visibility = "hidden";
            }
    }
</script>
<p id="solution">Solution : <?php echo $_SESSION["solution"]; ?></p>
<button  onclick="soumettre()" type="button" >voir la solution</button>


        </pre>
    </form>
    <script>
        function changerCouleur(element) {
            element.style.color = 'blue'; // ou toute autre couleur que tu préfères
        }

        function reinitialiserCouleur(element) {
            element.style.color = ''; // Réinitialise la couleur à celle par défaut
        }
    </script>
    <script>

</body>
</html>


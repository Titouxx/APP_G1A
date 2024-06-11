<?php
// Démarrez la session au début de chaque page PHP
session_start();

// Assurez-vous que l'utilisateur est connecté avant de procéder
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: Connexion.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../css/analyse.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <script src="../js/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <title>TransNoise - EchoKey</title>
</head>

<body>
    <header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="analyse.php">Analyse</a></li>
            <li><a href="faq.php">Faq</a></li>
            <li><a href="espaceuser.php">Profil</a></li>
        </ul>
    </nav>
    </header>
    <a href="index.php"><img src="../../images/EchoKey_extrude.png" id="Logo1" alt="Logo EchoKey" title="Logo EchoKey"></a> <!--logo EchoKey-->
    
    <h1>Analyse de vos performances</h1>
    <table>
        <tr>
            <td>Télécharger un fichier audio</td>
            <td>
                <label for="file-input"><img id="icon" src="../../images/dossier.png"
                        alt="Icone d'un dossier" /></label>
                <input id="file-input" type="file" accept="image/png, image/jpeg" style="display: none" />
            </td>
            <td style="padding-left: 40px">
                <select name="file" id="file-select">
                    <option value="">Choississez un fichier téléchargé</option>
                    <script>
                    const fileInput = document.querySelector("#file-input");
                    fileInput.addEventListener(
                        "change",
                        function addOptionInSelect() {
                            var x = document.getElementById("file-select");
                            var option = document.createElement("option");
                            for (const file of fileInput.files) {
                                option.value = file.name;
                                option.lastmodified = file.lastmodified;
                                option.size = file.size;
                                option.innerHTML = file.name;
                                x.appendChild(option);
                            }
                        }
                    );
                    </script>
                </select>
            </td>
            <td>
                <img id="icon" src="../../images/loupe.png" alt="Icone d'une loupe" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p id="selected">
                    Fichier sélectionné :
                    <script>
                    const select = document.querySelector("#file-select");
                    const selected = document.querySelector("#selected");
                    select.addEventListener("change", function printSelectedItem() {
                        if (select.options[select.selectedIndex].size >= 1) {
                            selected.innerHTML =
                                "Fichier sélectionné : " +
                                select.options[select.selectedIndex].value +
                                " " +
                                Math.round(
                                    select.options[select.selectedIndex].size / 1000
                                ) +
                                " ko";
                        }
                    });
                    </script>
                </p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2">
                <a id="titre1"> La représentation temporelle (amplitude/temps) </a>
                <p>
                    <img id="analyse1" src="../../images/Analyse1.png"></img>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <a id="titre2"> Représentation fréquentielle ou spectrale en bargraphe d’un son mono </a>
                <p>
                    <img id="analyse2" src="../../images/Analyse2.jpg"></img>
                </p>
            </td>
            <td>
                <a id="titre3"> Représentation 3D d’une voix </a>
                <p>
                    <img id="analyse3" src="../../images/Analyse3.png"></img>
                </p>
            </td>
        </tr>
    </table>



    <img src="../../images/collage.png" id="LogosFooter" alt="LogosFooter" title="LogosFooter"> <!--logo Transnoise-->
  <li>
    <!--logo déconnexion-->
    <img src="../../images/déconnexion_test.png" id="imgdeco" alt="logo déconnexion" title="logo déconnexion" onmouseover="changerImage('survol')" onmouseout="changerImage('normal')" onclick="deconnexion()">
  </li>
<footer>
  <div class="footer">
  <nav>
    <ul>
      <li><a href="CGU.php" id="ga" target="_blank">C.G.U</a></li>
      <li><a href="https://www.isep.fr/" id="ga" target="_blank">Nos investisseurs</a></li>
      <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
    </ul>
  </nav>
</div>
</footer>

    <script src="../js/analyse.js"> </script>
</body>
</html>
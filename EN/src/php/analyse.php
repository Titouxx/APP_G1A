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
    <nav>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="analyse.php">Analysis</a></li>
            <li><a href="faq.php">Faq</a></li>
            <li><a href="espaceuser.php">Profile</a></li>
        </ul>
    </nav>

    <img id="Logo" src="../../images/EchoKey.png" alt="Logo EchoKey" title="Logo EchoKey" />
    <!--logo EchoKey-->
    <h1>Analysis of Your Performances</h1>
    <table>
        <tr>
            <td>Download an audio file</td>
            <td>
                <label for="file-input"><img id="icon" src="../../images/dossier.png"
                        alt="Icone d'un dossier" /></label>
                <input id="file-input" type="file" accept="image/png, image/jpeg" style="display: none" />
            </td>
            <td style="padding-left: 40px">
                <select name="file" id="file-select">
                    <option value="">Choose a Downloaded File</option>
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
                    Selected File:
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
                <a id="titre1"> Temporal Representation (Amplitude/Time) </a>
                <p>
                    <img id="analyse1" src="../../images/Analyse1.png"></img>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <a id="titre2"> Frequency or Spectral Representation in Bar Graph of a Mono Sound </a>
                <p>
                    <img id="analyse2" src="../../images/Analyse2.jpg"></img>
                </p>
            </td>
            <td>
                <a id="titre3"> 3D Representation of a Voice </a>
                <p>
                    <img id="analyse3" src="../../images/Analyse3.png"></img>
                </p>
            </td>
        </tr>
    </table>

    <script src="../js/analyse.js"> </script>
</body>
<footer>
    <div>
        <nav>
            <ul>
                <li><a href="CGU.php" target="_blank">T&Cs</a></li>
                <li>
                    <a href="https://www.isep.fr/" target="_blank">Our Investors</a>
                </li>
                <li><a href="faq.php" target="_blank">Contact</a></li>
            </ul>
        </nav>
    </div>
</footer>

</html>
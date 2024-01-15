<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="../css/analyse.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <script src="../js/jquery.min.js"></script>

    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <title>TransNoise - EchoKey</title>
  </head>
  <body>
    <nav>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analyse</a></li>
        <li><a href="faq.php">Faq</a></li>
        <li><a href="espaceuser.php">Profil</a></li>
      </ul>
    </nav>

    <img
      id="Logo"
      src="../../images/EchoKey.png"
      alt="Logo EchoKey"
      title="Logo EchoKey"
    />
    <!--logo EchoKey-->
    <h1>Analyse de vos performances</h1>
    <table>
      <tr>
        <td>Télécharger un fichier audio</td>
        <td>
          <label for="file-input"
            ><img
              id="icon"
              src="../../images/dossier.png"
              alt="Icone d'un dossier"
          /></label>
          <input
            id="file-input"
            type="file"
            accept="image/png, image/jpeg"
            style="display: none"
          />
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
    <script src = "../js/analyse.js"> </script>
  </body>
  <footer>
    <div>
      <nav>
        <ul>
          <li><a href="CGU.php" target="_blank">C.G.U</a></li>
          <li>
            <a href="https://www.isep.fr/" target="_blank">Nos investisseurs</a>
          </li>
          <li><a href="faq.php" target="_blank">Contact</a></li>
        </ul>
      </nav>
    </div>
  </footer>
</html>

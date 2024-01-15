<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Édition du Profil</title>
    <link rel="stylesheet" href="../css/Profil.css" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>

  <body>
    <nav>
      <ul class="menu">
        <li><a href="Page_dacueil.php">Home</a></li>
        <li><a href="analyse.php">Analyse</a></li>
        <li><a href="faq.php">Faq</a></li>
        <li><a href="espaceuser.php">Profil</a></li>
      </ul>
    </nav>

    <!--logo EchoKey-->

    <div class="background"></div>
    <div class="logo-container">
      <a href="index.php" id="Logo1">
        <img
          src="../../images/EchoKey_extrude.png"
          alt="Logo EchoKey"
          title="Logo EchoKey"
        />
      </a>
    </div>
    <div class="ii">
      <div class="container1">
        <div class="content">
          <div class="sidebar">
            <ul class="menu2">
              <li>
                <button onclick="showSection('coordonnees')">
                  Coordonnées
                </button>
              </li>
              <li>
                <button onclick="showSection('parametres')">
                  . Paramètres .
                </button>
              </li>
              <!-- ... Ajoutez d'autres sections au besoin -->
            </ul>
          </div>
          <div class="profile-info">
            <h1>Édition du Profil</h1>

            <!-- Section de coordonnées (formulaire) -->
            <div id="coordonnees" class="section profile" style="display: none">
              <div class="form-group mb-3">
                <label class="col-md-4 control-label">Prénom</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-user"></i
                    ></span>
                    <input
                      name="first_name"
                      placeholder="Prénom"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <!-- Text input-->

              <div class="form-group mb-3">
                <label class="col-md-4 control-label">Nom</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-user"></i
                    ></span>
                    <input
                      name="last_name"
                      placeholder="Nom"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-envelope"></i
                    ></span>
                    <input
                      name="email"
                      placeholder="Addresse E-Mail"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <!-- Text input-->

              <div class="form-group">
                <label class="col-md-4 control-label">Téléphone#</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-earphone"></i
                    ></span>
                    <input
                      name="phone"
                      placeholder="Téléphone"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <!-- Text input-->

              <div class="form-group mb-2">
                <label class="col-md-4 control-label">Addresse</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-home"></i
                    ></span>
                    <input
                      name="address"
                      placeholder="Addresse"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>

              <!-- Text input-->

              <div class="form-group">
                <label class="col-md-4 control-label">Ville</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-home"></i
                    ></span>
                    <input
                      name="city"
                      placeholder="Ville"
                      class="form-control"
                      type="text"
                      disabled
                    />
                  </div>
                </div>
              </div>
            </div>

            <!-- Section des paramètres (vide dans le code fourni) -->
            <div id="parametres" class="section profile" style="display: none">
              <!-- Champs pour les paramètres -->
            </div>
            <button type="button" id="Modifier" onclick="activerEdition()">
              Modifier
            </button>
            <button
              type="button"
              id="Enregistrer"
              onclick="enregistrerEdition()"
              style="display: none"
            >
              Enregistrer
            </button>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="footer">
        <nav>
          <ul>
            <li><a href="CGU.php" id="ga" target="_blank">C.G.U</a></li>
            <li>
              <a href="https://www.isep.fr/" id="ga" target="_blank"
                >Nos investisseurs</a
              >
            </li>
            <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
          </ul>
        </nav>
      </div>
    </footer>
    <script src="../JS/Profil.js"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Profile</title>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="analyse.php">Analysis</a></li>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="espaceuser.php">Profile</a></li>
      </ul>
    </nav>
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
                <label for="Coordonnées" class="label_menu">
                  <img
                    class="menu-icon"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/users.png"
                    alt="Users Icon"
                  />
                  <button onclick="showSection('coordonnees')">
                    Contact Info
                  </button>
                </label>
              </li>
              <li>
                <label for="Paramètres" class="label_menu">
                  <img
                    class="menu-icon"
                    src="../../images/parametres-des-engrenages.png"
                    alt="Paramètres des engrenages"
                  />
                  <button onclick="showSection('parametres')">
                    Settings
                  </button>
                </label>
              </li>
              <li>
                <label for="Vos Enregistrement" class="label_menu">
                  <img
                    class="menu-icon"
                    src="../../images/message-vocal.png"
                    alt="Exit Icon"
                  />
                  <button onclick="showSection('Enregistrement')">
                    Recordings
                  </button>
                </label>
              </li>
              <li></li>
            </ul>
            <a href="logout.php"></a>
            <button class="Déconnexion" onclick="window.location.href='logout.php'">  
              <img
                class="menu-icon"
                src="../../images/se-deconnecter.png"
                alt="Exit Icon"
              />
              Logout
            </button>
          </div>
          <div class="profile-info">
            <h1>Edit Profile</h1>

            <?php
            include 'config.php';
            session_start(); // Démarre la session au début du script
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "siteweb";
            
            // $conn = new mysqli($servername, $username, $password, $dbname);
            
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }
            try{
              if(isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM user WHERE id_User = $user_id";
                $result = $conn->query($sql);
                // Rest of the code...
              } else {
                echo "User ID not found in session.";
              }
              
              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $first_name = $row["prenom"];
                  $last_name = $row["nom"];
                  $email = $row["email"];
                  $phone = $row["telephone"];
                  $adresse = $row["adresse"];
                  $city = $row["ville"];
                  $password = $row["password"];
              } else {
                  echo "No user found.";
              }
              if(isset($_SESSION['user_id'])) {
                // Si l'utilisateur est connecté, affichez un message différent

              } else {
                // Si l'utilisateur n'est pas connecté, affichez le bouton de connexion
                echo '<button class="cn" id="scrollButton"><a href="Connexion.php">Connectez Vous !</a></button>';
              }
            } catch (PDOException $e) {
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
            
            $conn->close();
            ?>
            
            <!-- Section de coordonnées (formulaire) -->
            <div id="coordonnees" class="section profile" style="display: none">
              <div class="form-group mb-3">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="first_name" id="first_name" placeholder="First Name" class="form-control" type="text" value="<?php echo $first_name; ?>" disabled />
                  </div>
                </div>
              </div>
            
              <!-- Text input-->
            
              <div class="form-group mb-3">
                <label class="col-md-4 control-label">Last Name</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="last_name" id="last_name" placeholder="Last Name" class="form-control" type="text" value="<?php echo $last_name; ?>" disabled />
                  </div>
                </div>
              </div>
            
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="email" id="email" placeholder="E-Mail" class="form-control" type="text" value="<?php echo $email; ?>" disabled />
                  </div>
                </div>
              </div>
            
              <!-- Text input-->
            
              <div class="form-group">
                <label class="col-md-4 control-label">Phone#</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="phone" id="phone" placeholder="Phone" class="form-control" type="text" value="<?php echo $phone; ?>" disabled />
                  </div>
                </div>
              </div>
            
              <!-- Text input-->
            
              <div class="form-group mb-2">
                <label class="col-md-4 control-label">Address</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="adresse" id="adresse" placeholder="Address" class="form-control" type="text" value="<?php echo $adresse; ?>" disabled />
                  </div>
                </div>
              </div>
            
              <!-- Text input-->
            
              <div class="form-group">
                <label class="col-md-4 control-label">City</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="city" id="city" placeholder="City" class="form-control" type="text" value="<?php echo $city; ?>" disabled />
                  </div>
                </div>
              </div>
            </div>
            

            <!-- Section des paramètres (vide dans le code fourni) -->
            <div id="parametres" class="section profile" style="display: none">
            <div class="form-group mb-3">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-8 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-user"></i
                    ></span>
                    <input
                      name="password"
                      placeholder="Mot de passe"
                      class="form-control"
                      type="password"
                      value="<?php echo $password; ?>"
                      disabled
                    />
                  </div>
                </div>
              </div>
            </div>
            <button class="Edition" type="button" id="Modifier" onclick="activerEdition()">
              Edit
            </button>
            <button
              class="Edition"
              type="button"
              id="Enregistrer"
              onclick="enregistrerEdition()"
              style="display: none"
            >
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="footer">
        <nav>
          <ul>
            <li><a href="CGU.php" id="ga" target="_blank">T&Cs</a></li>
            <li><a href="https://www.isep.fr/" id="ga" target="_blank">Our Investors</a></li>
            <li><a href="faq.php" id="ga" target="_blank">Contact</a></li>
          </ul>
        </nav>
      </div>
    </footer>
    <script src="../js/Profil.js"></script>

  </body>
</html>
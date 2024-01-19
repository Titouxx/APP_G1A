<!DOCTYPE html>
<html lang="en">
  <!--web banner-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <title>TransNoise - EchoKey</title>
        <link rel="stylesheet" href="../css/forum.css"/>


        <link rel="stylesheet" href="../css/normalize.css" />
        <link rel="stylesheet" href="../css/espaceuser.css" />
        <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
        <script src="../js/jquery.min.js"></script>
    </head>
    <!--background and menu bar-->
    <body background="../../images/bgtest2.png">
        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="analyse.php">Analyse</a></li>
                <li><a href="faq.php">Faq</a></li>
                <li><a href="espaceuser.php">Profil</a></li>
            </ul>
        </nav>
        <!--forum header-->
        <header>
        <img src="../../images/forumpic2.png" />
        </header>


        <!-- forum section -->
        <div class="forum-section">
            <div class="post-form">
                <h2>...commencer une nouvelle discussion !</h2>
                <input type="text" id="discussionTitle" placeholder="Titre" />
                <textarea id="discussionContent" placeholder="Message"></textarea>
                <button onclick>Créer Discussion</button>
                <h2>...ou rejoindre une discussion en cours !</h2>
            </div>
            <div class="discussion-list" id="discussionList">
                <!-- PHP Script to Load Discussions -->
                <?php
                    include 'db_connect.php';


                    $stmt = $pdo->query("SELECT id, topic_name FROM discussions");
                    $discussions = $stmt->fetchAll();


                    foreach ($discussions as $discussion) {
                        echo "<div class='discussion-item'>";
                        echo "<h3><a href='discussion.php?id=" . $discussion['id'] . "'>" . htmlspecialchars($discussion['topic_name']) . "</a></h3>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>
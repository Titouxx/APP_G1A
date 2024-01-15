<?php
// Establish a database connection
$db = new mysqli('localhost', 'root', '', 'siteweb');

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Create a new topic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_topic'])) {
    $username = $_POST['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $userQuery = $db->prepare("INSERT INTO users (username) VALUES (?)");
    $userQuery->bind_param("s", $username);
    $userQuery->execute();
    $userQuery->close();

    $id_User = $db->insert_id;

    $topicQuery = $db->prepare("INSERT INTO topics (user_id, title, content) VALUES (?, ?, ?)");
    $topicQuery->bind_param("iss", $id_User, $title, $content);
    $topicQuery->execute();
    $topicQuery->close();
}

// Get topics and posts
$result = $db->query("SELECT * FROM topics ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>TransNoise - EchoKey</title>
    <link rel="stylesheet" href="../css/forum-manel.css" />

    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/espaceuser.css" />
    <link rel="icon" type="image/x-icon" href="../../images/TransNoise.ico" />
    <script src="../js/jquery.min.js"></script>
  </head>
  <body background="../../images/bgtest2.png">
    <nav>
      <ul class="menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="analyse.html">Analyse</a></li>
        <li><a href="faq.html">Faq</a></li>
        <li><a href="espaceuser.html">Profil</a></li>
      </ul>
    </nav>

    <header>
      <img src="../../images/forumpic2.png" />
    </header>
    <!-- Form to create a new topic -->
    <h3>Créer une nouvelle disucssion...</h3>
    <form method="post" action="forum.php">
      <label for="username">Votre Pseudo</label>
      <input type="text" name="username" required /><br />
      <label for="title">Titre</label>
      <input type="text" name="title" required /><br />
      <label for="content">Sujet</label>
      <textarea name="content" required></textarea><br />
      <input type="submit" name="create_topic" value="Create Topic" />
    </form>
    <!-- Display topics -->
    <h3>...ou rejoindre une discussion en cours !</h3>
    <ul>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li>
                <strong><?= $row['title'] ?></strong><br>
                <?= $row['content'] ?><br>
                <em>Created by <?= $row['user_id'] ?> at <?= $row['created_at'] ?></em>
            </li>
        <?php } ?>
    </ul>

  </body>
</html>


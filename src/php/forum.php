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
            <form class="post-form" id="newDiscussionForm" action="post_discussion.php" method="post">
                <input type="text" name="topicName" placeholder="Titre" required />
                <textarea name="openingMessage" placeholder="Message" required></textarea>
                <button type="submit">Créer Discussion</button>
            </form>

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
        <script>
            $(document).ready(function() {
                $('#newDiscussionForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting via the browser
                    
                    var form = $(this);
                    var url = form.attr('action'); // You might need to set this to 'post_discussion.php'
                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(), // serializes the form's elements
                        success: function(response) {
                            // Assuming the PHP script returns a JSON object
                            var data = JSON.parse(response);
                            
                            // Construct the HTML for the new discussion item
                            var newDiscussionHtml = '<div class="discussion-item">' +
                                                    '<h3><a href="discussion.php?id=' + data.id + '">' + 
                                                    data.topic_name + 
                                                    '</a></h3>' +
                                                    '<p>' + data.opening_message + '</p>' +
                                                    '</div>';
                            
                            // Append the new discussion HTML to the list of discussions
                            $('#discussionList').append(newDiscussionHtml);
                        }

                    });
                });
            });
        </script>
    </body>
</html>
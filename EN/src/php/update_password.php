<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'fail', 'message' => 'Non authentifié']);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siteweb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo json_encode(['status' => 'fail', 'message' => 'Erreur de connexion à la base de données']);
    exit();
}

$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
  // Redirigez vers la page de connexion ou gérez le cas où l'utilisateur n'est pas connecté
  header("Location: login.php");
  exit();
}

// Récupérez l'identifiant de l'utilisateur à partir de la session
$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT password FROM user WHERE id_User = '$user_id'");

if (!$result) {
    echo json_encode(['status' => 'fail', 'message' => 'Erreur de requête SQL : ' . mysqli_error($conn)]);
    exit();
}

$user = mysqli_fetch_assoc($result);
$hashedPasswordFromDatabase = $user['password'];
//echo "<script>console.log('Hashed password DATA: " . $hashedPasswordFromDatabase . "');</script>";
//$hashedCurrentPassword = password_hash($oldPassword, PASSWORD_DEFAULT);
//echo "<script>console.log('Hashed password: " . $hashedCurrentPassword . "');</script>";


if (password_verify($oldPassword,$hashedPasswordFromDatabase)) {
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateResult = mysqli_query($conn, "UPDATE user SET password = '$hashedNewPassword' WHERE id_User = '$user_id'");

    if ($updateResult) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Erreur de mise à jour du mot de passe : ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Ancien mot de passe incorrect']);
}

$conn->close();
?>

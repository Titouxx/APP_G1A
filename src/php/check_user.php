<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
    } else {
  echo json_encode(["logged_in" => true, "user_id" => $_SESSION["user_id"]]);
}
?>
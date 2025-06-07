<?php
function getPDOConnection(): PDO {
    $hostname = "localhost";
    $base = "siteweb";
    $loginBD = "root";
    $passBD = ""; //root for mac

    try {
        $dsn = "mysql:host=$hostname;dbname=$base;charset=utf8";
        $pdo = new PDO($dsn, $loginBD, $passBD, [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        die();
    }
}
?>

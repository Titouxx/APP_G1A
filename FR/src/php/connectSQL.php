<?php
function getPDOConnection(): PDO {
    $hostname = "localhost";
    $base = "siteweb";
    $loginBD = "root";
    $passBD = "root"; //root for mac

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


// function getPDOConnection(): PDO
// {
//     $hostname = "mysql-nutritium.alwaysdata.net"; // hôte MySQL AlwaysData
//     $base = "nutritium_db";                       // nom de la base
//     $loginBD = "nutritium";                       // nom d'utilisateur MySQL
//     $passBD = "Nutritiumadmin123*";

//     try {
//         $dsn = "mysql:host=$hostname;dbname=$base;charset=utf8";
//         $pdo = new PDO($dsn, $loginBD, $passBD, [
//             PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ]);
//         return $pdo;
//     } catch (PDOException $e) {
//         echo "Erreur de connexion : " . $e->getMessage();
//         die();
//     }
// }
?>
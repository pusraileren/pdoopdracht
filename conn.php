<?php
$host = "localhost";
$user = "root";
$db = "winkel1";
$pass = "";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
    echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        ?>
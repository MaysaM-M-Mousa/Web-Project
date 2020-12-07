<?php
$servername = "localhost";
$username = "maysam";
$password = "123";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=testdatabase", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
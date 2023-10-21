<?php

$host = 'localhost';
$dbName = 'gestion_voyage';
$userName = 'root';
$userPass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $userName, $userPass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (\PDOException $th) {
    $th->getMessage();
}

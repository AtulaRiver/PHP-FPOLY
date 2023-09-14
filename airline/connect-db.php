<?php

$host = 'localhost';
$dbname = 'db_plane';
$username = 'root';
$password = '';

try {
    $connectDB = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die($exception->getMessage());
}

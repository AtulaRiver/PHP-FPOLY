<?php
    $sv = 'localhost';
    $username = 'root';
    $pass = '';
    $db = 'giay_example1';
    try {
        $conn = new PDO("mysql:host=$sv;dbname=$db", $username, $pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die($e -> getMessage());
    }
?>
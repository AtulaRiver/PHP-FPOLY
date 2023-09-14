<?php
    $sv = "localhost";
    $user = "root";
    $pass = "";
    $db = "asm2";

    try {
        $conn = new PDO("mysql:host=$sv;dbname=$db", $user, $pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die($e -> getMessage());
    }
?>
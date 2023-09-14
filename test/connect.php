<?php
    $sv = "localhost";
    $user = "root";
    $pass = "";
    $db = "test";

    try {
        $conn = new PDO("mysql:localhost=$sv;dbname=$db", $user, $pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e -> getMessage());
    }
?>
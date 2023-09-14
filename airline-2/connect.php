<?php
    $sv = "localhost";
    $user = "root";
    $pass = "";
    $db = "plane";
    try {
        $conn = new PDO("mysql:localhost=$sv;dbname=$db", $user, $pass);
    } catch(PDOException $e) {
        die($e -> getMessage());
    } 
?>
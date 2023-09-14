<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "productlist";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die($e -> getMessage());
    }
<?php

require_once __DIR__ . "/../connect.php";

$sql = '
    select * from categories;
';

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt -> setFetchMode(PDO::FETCH_ASSOC);
    $categories = $stmt -> fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

require_once __DIR__ . "/../close.php";

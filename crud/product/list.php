<?php

require_once __DIR__ . "/../connect.php";

$sql = '
    select p.id, p.ten, p.mota, p.anh, hangsanxuat, c.name from products as p
    inner join categories as c on p.category_id = c.id;
';

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt -> setFetchMode(PDO::FETCH_ASSOC);
    $products = $stmt -> fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

require_once __DIR__ . "/../close.php";

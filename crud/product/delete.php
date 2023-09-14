<?php
require_once __DIR__ . '/../connect.php';

$id = $_GET["id"] ?? null;

$sql = '
        delete from products
        where id = :id;
    ';

try {
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();
} catch (PDOException $PDOException) {
    die($PDOException->getMessage());
}

require_once __DIR__ . '/../close.php';
header("Location: ../product.php");




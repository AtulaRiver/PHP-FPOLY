<?php
require_once 'connect.php';
$sql = '
            select * from color;
        ';
try {
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $list = $stmt->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}
require_once 'close.php';

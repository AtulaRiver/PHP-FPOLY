<?php

require_once __DIR__ . '/../connect-db.php';

$sql = 'SELECT * FROM categories;';

try {
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $PDOException) {
    die($PDOException->getMessage());
}

require_once __DIR__ . '/../close-db.php';

<?php

require_once __DIR__ . '/../connect-db.php';

$id = $_GET['id'] ?? null;

$sql = 'DELETE FROM categories WHERE id = :id;';

try {
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();
} catch (PDOException $PDOException) {
    die($PDOException->getMessage());
}

require_once __DIR__ . '/../close-db.php';

header("Location: ../category.php");
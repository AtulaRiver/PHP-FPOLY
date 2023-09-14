<?php

require_once '../connect-db.php';

try {
    $sql = 'DELETE FROM flights WHERE flight_id = :flight_id';

    $stmt = $connectDB->prepare($sql);

    $stmt->bindParam(':flight_id', $_GET['flight_id']);

    $stmt->execute();

    header('Location: ../index.php');
} catch (PDOException $exception) {
    die($exception->getMessage());
}

require_once '../close-db.php';
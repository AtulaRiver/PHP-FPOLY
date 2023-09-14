<?php
    require_once 'connect.php';
    try {
        $sql = 'delete from flights where flight_id = :flight_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":flight_id", $_GET['flight_id']);
        $stmt -> execute();
        header("Location: index.php");
    } catch(PDOException $e) {
        die($e -> getMessage());
    }
    require_once 'close.php';
?>
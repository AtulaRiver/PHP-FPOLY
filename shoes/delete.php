<?php
    require_once 'connect.php';

    try {
        $sql = 'delete from shoes where shoe_id = :shoe_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":shoe_id", $_GET['shoe_id']);
        $stmt->execute();
        header("Location: index.php");
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
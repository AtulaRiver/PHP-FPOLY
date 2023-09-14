<?php
    require_once 'connect.php';

    try {
        $sql = 'delete from product where product_id = :product_id';
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(':product_id', $_GET['product_id']);

        $stmt->execute();
        header("Location: index.php");
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
<?php
    require_once 'connect.php';

    try {
        $sql = 'delete from users where user_id = :user_id';
        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':user_id', $_GET['user_id']);
        $stmt -> execute();
        header("Location: index.php");
    } catch(PDOException $e) {  
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
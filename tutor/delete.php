<?php
    require_once 'connect.php';

    try {
        $sql = 'delete from movies
        where movie_id = :movie_id';

        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(':movie_id', $_GET['movie_id']);
        $stmt -> execute();
        header("Location: index.php");
    } catch(PDOException $e) {  
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
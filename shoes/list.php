<?php
    require_once 'connect.php';

    try {
        $sql = 'select s.*, c.category_name from shoes s 
        join categories c on s.category_id = c.category_id';
        $data = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
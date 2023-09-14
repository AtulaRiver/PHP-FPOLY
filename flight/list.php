<?php
    require_once 'connect.php';
    try {
        $sql = 'select f.*, a.airline_name from flights f
        join airlines a on a.airline_id = f.airline_id';
        $data = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }
    require_once 'close.php';
?>
<?php
    require_once 'connect.php';

    try {
        $sql = 'select p.*, c.customers_name from product p
        join customers c on p.customers_id = c.customers_id';
        $data = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    require_once 'close.php';
?>
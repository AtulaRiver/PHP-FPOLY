<?php
    require_once 'connect.php';
    try {
        $sql = 'select u.*, r.role_name from users u join roles r on u.role_id = r.role_id';
        $data = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {  
        die($e -> getMessage());
    }
    require_once 'close.php';
?>
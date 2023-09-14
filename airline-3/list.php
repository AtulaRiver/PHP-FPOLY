<?php
    require_once 'connect.php';
    $sql = 'select f.flight_id, f.flight_number, f.total_passengers, f.description, f.img, f.airline_id, a.airline_name from flights as f
    inner join airlines as a on a.airline_id = f.airline_id';
    try {
        $data = $conn->query($sql)->fetchAll();
    } catch (PDOException $e) {
        die($e -> getMessage());
    }
    require_once 'close.php';
?>
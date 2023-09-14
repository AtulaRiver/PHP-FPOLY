<?php

require_once 'connect-db.php';

try {
    $sql = '
            SELECT 
                f.flight_id, f.flight_name,f.image,f.total_passenger,f.description,
                a.airline_id, a.airline_name
            FROM flights f
            INNER JOIN airlines a
                ON f.airline_id = a.airline_id
           ';

    $stmt = $connectDB->prepare($sql);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $data = $stmt->fetchAll();
} catch (PDOException $exception) {
    die($exception->getMessage());
}
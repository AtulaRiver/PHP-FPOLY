<?php

require_once 'connect-db.php';

try {
    $sql1 = 'SELECT * FROM airlines';
    $stmt = $connectDB->prepare($sql1);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $airlines = $stmt->fetchAll();

    $sql2 = 'SELECT * FROM flights WHERE flight_id = :flight_id';
    $stmt = $connectDB->prepare($sql2);
    $stmt->bindParam(':flight_id', $_GET['flight_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $flight = $stmt->fetch();

} catch (PDOException $exception) {
    die($exception->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_id = $_POST['flight_id'];
    $flight_name = $_POST['flight_name'];
    $total_passengers = $_POST['total_passengers'];
    $description = $_POST['description'];
    $airline_id = $_POST['airline_id'];
    $old_image = $_POST['old_image'];
    $image = $_FILES['image'];

    try {
        $sql = 'UPDATE flights
                SET flight_name = :flight_name, 
                    total_passengers = :total_passengers, 
                    description = :description, 
                    airline_id = :airline_id, 
                    image = :image
                WHERE flight_id = :flight_id';

        $stmt = $connectDB->prepare($sql);

        $stmt->bindParam(':flight_id', $flight_id);
        $stmt->bindParam(':flight_name', $flight_name);
        $stmt->bindParam(':total_passengers', $total_passengers);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':airline_id', $airline_id);

        if ($image['size'] > 0) {
            $targetPath = 'upload/' . time() . $image['name'];
            move_uploaded_file($image['tmp_name'], $targetPath);

            $stmt->bindParam(':image', $targetPath);
 
            unlink($old_image); // Xóa ảnh cũ
        } else {
            $stmt->bindParam(':image', $old_image);
        }

        $stmt->execute();

        header('Location: index.php');
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
}
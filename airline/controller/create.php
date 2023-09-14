<?php

require_once 'connect-db.php';
$flight_nameErr = $total_passengerErr = $descriptionErr = $airline_idErr = $imageErr = null;

try {
    $sql = 'SELECT * FROM airlines';

    $stmt = $connectDB->prepare($sql);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $airlines = $stmt->fetchAll();
} catch (PDOException $exception) {
    die($exception->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_name = $_POST['flight_name'];
    $total_passenger = $_POST['total_passenger'];
    $description = $_POST['description'];
    $airline_id = $_POST['airline_id'];
    $image = $_FILES['image'];
    if (empty($flight_name)) {
        $flight_nameErr = "Xin hãy nhập tên chuyến bay!";
    }
    if (empty($total_passenger)) {
        $total_passengerErr = "Xin hãy nhập số hành khách!";
    }
    if (empty($airline_id)) {
        $airline_idErr = "Xin hãy chọn hãng chuyến bay!";
    }
    if (
        empty($flight_nameErr)
        && empty($total_passengerErr)
        && empty($airline_idErr)
    ) {
        try {
            $sql = 'INSERT INTO flights 
                        (flight_name, total_passenger, description, airline_id, image)
                    VALUES (:flight_name, :total_passenger, :description, :airline_id, :image)';

            $stmt = $connectDB->prepare($sql);

            $stmt->bindParam(':flight_name', $flight_name);
            $stmt->bindParam(':total_passenger', $total_passenger);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':airline_id', $airline_id);

            $targetPath = 'upload/' . time() . $image['name'];
            move_uploaded_file($image['tmp_name'], $targetPath);

            $stmt->bindParam(':image', $targetPath);

            $stmt->execute();

            header('Location: index.php');
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }
}

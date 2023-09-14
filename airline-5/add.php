<?php
require_once 'connect.php';
    try {
        $sql = 'select * from airlines';
        $airlines = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $flight_name = $_POST['flight_name'];
        $total_passengers = $_POST['total_passengers'];
        $description = $_POST['description'];
        $airline_id = $_POST['airline_id'];
        $img = $_FILES['img'];
        try {
            $sql = 'insert into flights(flight_name,
            total_passengers,
            description,
            airline_id,
            img)
            values (:flight_name,
            :total_passengers,
            :description,
            :airline_id,
            :img)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":flight_name", $flight_name);
            $stmt->bindParam(":total_passengers", $total_passengers);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":airline_id", $airline_id);

            $imgFile = 'img/' . time() . $img['name'];
            move_uploaded_file($img['tmp_name'], $imgFile);
            $stmt->bindParam(":img", $imgFile);
            $stmt->execute();
            header("Location: index.php");
            
        } catch(PDOException $e) {
            die($e -> getMessage());
        }
    }
    require_once 'close.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Them</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Flight Name:</label>
            <input class="form-control" type="text" name="flight_name" id=""> <br>
            <label for="">Image:</label>
            <input class="form-control" type="file" name="img" id=""> <br>
            <label for="">Airline Name:</label>
            <select class="form-control" name="airline_id" id=""> <br>
                <?php foreach($airlines as $airline): ?>
                    <option value="<?= $airline['airline_id']?>" ><?= $airline['airline_name']?></option>
                <?php endforeach ?>
            </select> <br>
            <label for="">Total Passengers:</label>
            <input class="form-control" type="text" name="total_passengers" id=""> <br>
            <label for="">Description:</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea> <br>
            <input class="btn btn-primary" type="submit" value="Lưu">
        </form>
    </div>
</body>
</html>
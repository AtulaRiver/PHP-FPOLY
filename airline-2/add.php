<?php
require_once "connect.php";

try {
    $sql = 'select * from airlines';
    $airlines = $conn->query($sql)->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $flight_number = $_POST['flight_number'];
    $img = $_FILES['img'];
    $total_passengers = $_POST['total_passengers'];
    $description = $_POST['description'];
    $airline_id = $_POST['airline_id'];

    try {
        $sql = '
            insert into flights (flight_number, img, total_passengers, description, airline_id)
            values (:flight_number, :img, :total_passengers, :description, :airline_id);
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":flight_number", $flight_number);
        $stmt->bindParam(":total_passengers", $total_passengers);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":airline_id", $airline_id);

        $imgFile = "img/" . time() . $img['name'];
        move_uploaded_file($img['tmp_name'], $imgFile);

        $stmt->bindParam(":img", $imgFile);

        $stmt->execute();
        header("Location: ./index.php");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
require_once "close.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Flight Number:</label>
            <input type="text" name="flight_number" id="" class="form-control"> <br>
            <label for="">Image:</label>
            <input type="file" name="img" id="" class="form-control"> <br>
            <label for="">Total Passengers:</label>
            <input type="text" name="total_passengers" id="" class="form-control"> <br>
            <label for="">Airline Name:</label>
            <select name="airline_id" class="form-control" id="">
                <?php foreach ($airlines as $airline) : ?>
                    <option value="<?= $airline['airline_id'] ?>"><?= $airline['airline_name'] ?></option>
                <?php endforeach ?>
            </select> <br>
            <label for="">Description:</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            <br>
            <input type="submit" value="Lưu" class="btn btn-primary">
        </form>
    </div>
</body>

</html>
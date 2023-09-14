<?php
require_once 'connect.php';
try {
    $sql1 = 'select * from airlines';
    $airlines = $conn->query($sql1)->fetchAll();

    $sql2 = 'select * from flights where flight_id = :flight_id';
    $stmt = $conn->prepare($sql2);
    $stmt->bindParam(':flight_id', $_GET['flight_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $flights = $stmt->fetch();
} catch (PDOException $e) {
    die($e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_name = $_POST['flight_name'];
    $flight_id = $_POST['flight_id'];
    $img = $_FILES['img'];
    $total_passengers = $_POST['total_passengers'];
    $description = $_POST['description'];
    $airline_id = $_POST['airline_id'];
    $old_img = $_POST['old_img'];
    try {
        $sql = "update flights 
        set flight_name = :flight_name,
        total_passengers = :total_passengers,
        description = :description,
        airline_id = :airline_id,
        img = :img
        where flight_id = :flight_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':flight_name', $flight_name);
        $stmt->bindParam(':flight_id', $flight_id);
        $stmt->bindParam(':total_passengers', $total_passengers);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':airline_id', $airline_id);
        if ($img['size'] > 0) {
            $imgFile = "img/" . time() . $img['name'];
            move_uploaded_file($img['tmp_name'], $imgFile);
            $stmt->bindParam(':img', $imgFile);
            unlink($old_img);
        } else {
            $stmt->bindParam(':img', $old_img);
        }
        $stmt->execute();

        header("Location: index.php");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
require_once 'close.php';
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
            <input type="hidden" name="flight_id" value="<?= $flights['flight_id'] ?>">
            <input type="hidden" name="old_img" value="<?= $flights['img'] ?>">
            <label for="">Flight Name:</label>
            <input class="form-control" type="text" name="flight_name" value="<?= $flights['flight_name'] ?>" id=""> <br>
            <label for="">Image:</label>
            <input class="form-control" type="file" name="img" id="">
            <img src="<?= $flights['img'] ?>" alt="" style="max-width: 100px;" class="my-3"> <br>

            <label for="">Airline Name:</label>
            <select class="form-control" name="airline_id" id="">
                <?php foreach ($airlines as $airline) : ?>
                    <option <?php if ($airline['airline_id'] == $flights['airline_id']) : ?> selected <?php endif ?> value="<?= $airline['airline_id'] ?>"><?= $airline['airline_name'] ?>
                    </option>
                <?php endforeach ?>
            </select> <br>
            <label for="">Total Passengers:</label>
            <input class="form-control" type="text" name="total_passengers" id="" value="<?= $flights['total_passengers'] ?>"> <br>
            <label for="">Description:</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10"><?= $flights['description'] ?></textarea> <br>
            <input class="btn btn-primary" type="submit" value="Lưu">
        </form>
    </div>
</body>

</html>
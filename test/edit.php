<?php
require_once 'connect.php';

try {
    $sql = '
            select * from color;
            ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $list = $stmt->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $ten = $_POST["ten"];
    $anh = $_FILES["anh"];
    $mau = $_POST["mau"];
    
    try {
        $sql = '
            update color
            set ten = :ten,
            anh = :anh,
            mau = :mau
            where id = :id;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ten", $ten);
        $stmt->bindParam(":mau", $mau);
        $imgFile = 'img/' . time() . $anh['name'];
        move_uploaded_file($anh['tmp_name'], $imgFile);
        $stmt->bindParam(":anh", $imgFile);

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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <style>
        table {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id">
            <label for="">Tên:</label>
            <input type="text" class="form-control" name="ten" id=""> <br>
            <label for="">Ảnh:</label>
            <input type="file" class="form-control" name="anh" id=""><br>
            <label for="">Màu:</label>
            <input type="color" class="form-control" name="mau" id=""><br>
            <input type="submit" value="Lưu" class="btn btn-primary">
        </form>
    </div>
</body>

</html>
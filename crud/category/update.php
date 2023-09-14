<?php

require_once "../connect.php";

function getID($conn, $id) {
    try {
        $sql = '
            select * from categories where id = :id;
        ';

        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);

        return $stmt -> fetch();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }
};

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $model = getID($conn, $id);

}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $color = $_POST["color"];

    $model = getID($conn, $id);

    if(empty($model)) {
        die('khong ton tai ID');
    }

    $sql = '
        update categories 
        set name = :name,
        color = :color
        where id = :id;
    ';

    try {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':color', $color);

        $stmt->execute();
    } catch (PDOException $PDOException) {
        die($PDOException->getMessage());
    }
    header("Location: ../category.php");
}

require_once "../close.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Sửa sản phẩm</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $model['id'] ?>">
            <div class="mb-3 mt-3">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" value="<?= $model['name'] ?>" name="name">
            </div>
            <div class="mb-3">
                <label for="color">Color:</label>
                <input type="color" class="form-control" id="color" value="<?= $model['color'] ?>" name="color">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</body>

</html>
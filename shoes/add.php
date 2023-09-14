<?php
    require_once 'connect.php';
    require_once 'check-log.php';

    try {
        $sql = 'select * from categories';
        $categories = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $shoe_name = $_POST['shoe_name'];
        $image = $_FILES['image'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        try {
            $sql = 'insert into shoes(shoe_name,
            image,
            price,
            category_id) values (
                :shoe_name,
                :image,
                :price,
                :category_id
            )';
            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(':shoe_name', $shoe_name);
            $stmt -> bindParam(':price', $price);
            $stmt -> bindParam(':category_id', $category_id);

            $imgFile = 'img/' . time() . $image['name'];
            move_uploaded_file($image['tmp_name'], $imgFile);

            $stmt -> bindParam(':image', $imgFile);

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
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" enctype="multipart/form-data" method="post">
            <label for="">Shoe Name:</label>
            <input type="text" name="shoe_name" class="form-control" id=""> <br>
            <label for="">Image:</label>
            <input type="file" name="image" class="form-control" id=""> <br>
            <label for="">Price:</label>
            <input type="text" name="price" class="form-control" id=""> <br>
            <label for="">Category Name:</label>
            <select class="form-control" name="category_id" id="">
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach ?>
            </select>    
            <br>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
</body>
</html>
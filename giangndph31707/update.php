<?php
    require_once 'connect.php';
    require_once 'check-login.php';
    try {
        $sql1 = 'select * from categories';
        $categories = $conn->query($sql1)->fetchAll();

        $sql2 = 'select * from shoes where shoe_id = :shoe_id';
        $stmt = $conn->prepare($sql2);
        $stmt->bindParam(':shoe_id', $_GET['shoe_id']);
        $stmt->execute();
        $shoe = $stmt -> fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $shoe_name = $_POST['shoe_name'];
        $shoe_id = $_POST['shoe_id'];
        $image = $_FILES['image'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $old_img = $_POST['old_img'];

        try {
            $sql = 'update shoes
            set 
            shoe_name = :shoe_name,
            image = :image,
            price = :price,
            category_id = :category_id
            where shoe_id = :shoe_id';
            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(':shoe_name', $shoe_name);
            $stmt -> bindParam(':shoe_id', $shoe_id);
            $stmt -> bindParam(':price', $price);
            $stmt -> bindParam(':category_id', $category_id);
            if($image['size'] > 0) {
                $imgFile = 'img/' . time() . $image['name'];
                move_uploaded_file($image['tmp_name'], $imgFile);

                $stmt -> bindParam(':image', $imgFile);
                unlink($old_img);
            } else {
                $stmt -> bindParam(':image', $old_img);
            }

            $stmt -> execute();
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
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" enctype="multipart/form-data" method="post">
            <input type="hidden" name="shoe_id" value='<?= $shoe['shoe_id'] ?>'>
            <input type="hidden" name="old_img" value='<?= $shoe['image'] ?>'>
            <label for="">Shoe Name:</label>
            <input type="text" name="shoe_name" class="form-control" id="" value='<?= $shoe['shoe_name'] ?>'> <br>
            <label for="">Image:</label>
            <input type="file" name="image" class="form-control" id=""> 
            <img style="max-width: 100px; border-radius: 4px;" class="my-3" src="<?= $shoe['image'] ?>" alt=""><br>
            <label for="">Price:</label>
            <input type="number" name="price" class="form-control" id="" value='<?= $shoe['price'] ?>'> <br>
            <label for="">Category Name:</label>
            <select class="form-control" name="category_id" id="">
                <?php foreach($categories as $category): ?>
                    <option 
                    <?php if($category['category_id'] == $shoe['category_id'] ):?>
                        selected
                    <?php endif ?>
                    value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach ?>
            </select> <br>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
</body>
</html>
<?php
    require_once 'connect.php';

    try {
        $sql1 = 'select * from customers';
        $customers = $conn->query($sql1)->fetchAll();

        $sql2 = 'select * from product where product_id = :product_id';
        $stmt = $conn->prepare($sql2);
        $stmt -> bindParam(':product_id', $_GET['product_id']);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $image = $_FILES['image'];
        $price = $_POST['price'];
        $customers_id = $_POST['customers_id']; 
        $old_img = $_POST['old_img'];
        try {
            $sql = 'update product
            set
            product_name = :product_name,
            image = :image,
            price = :price,
            customers_id = :customers_id
            where product_id = :product_id';

            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':product_id', $product_id);
            $stmt -> bindParam(':product_name', $product_name);
            $stmt -> bindParam(':price', $price);
            $stmt -> bindParam(':customers_id', $customers_id);

            if($image['size'] > 0 ) {
                $imgFile =  'img/' . time() . $image['name'];
                move_uploaded_file($image['tmp_name'], $imgFile);
    
                $stmt -> bindParam(':image', $imgFile);
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
    <title>Sua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" enctype="multipart/form-data" method="post">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <input type="hidden" name="old_img" value="<?= $product['image'] ?>">
            <label for="">Product Name:</label>
            <input class="form-control" type="text" name="product_name" id="" value="<?= $product['product_name'] ?>"> <br>
            <label for="">Image:</label>
            <input class="form-control" type="file" name="image" id=""> 
            <img style="max-width: 100px;" class="my-3" src="<?= $product['image'] ?>" alt=""><br>
            <label for="">Price:</label>
            <input class="form-control" type="text" name="price" id="" value="<?= $product['price'] ?>"> <br>
            <label for="">Customer Name:</label>
            <select name="customers_id" class="form-control" id="">
                <?php foreach($customers as $customer): ?>
                    <option 
                    <?php if($product['customers_id'] == $customer['customers_id']): ?>
                    selected
                    <?php endif ?>
                    value="<?= $customer['customers_id'] ?>"><?= $customer['customers_name'] ?></option>
                <?php endforeach ?>    
            </select> <br>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
</body>
</html>

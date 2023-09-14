<?php
    require_once 'connect.php';

    try {
        $sql = 'select * from customers';
        $customers = $conn->query($sql)->fetchAll();
    } catch(PDOException $e) {
        die($e -> getMessage());
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $product_name = $_POST['product_name'];
        $image = $_FILES['image'];
        $price = $_POST['price'];
        $customers_id = $_POST['customers_id']; 

        try {
            $sql = 'insert into product(
            product_name,
            image,
            price,
            customers_id) values (:product_name,
            :image,
            :price,
            :customers_id)';

            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':product_name', $product_name);
            $stmt -> bindParam(':price', $price);
            $stmt -> bindParam(':customers_id', $customers_id);
            $imgFile =  'img/' . time() . $image['name'];
            move_uploaded_file($image['tmp_name'], $imgFile);

            $stmt -> bindParam(':image', $imgFile);

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
            <label for="">Product Name:</label>
            <input class="form-control" type="text" name="product_name" id=""> <br>
            <label for="">Image:</label>
            <input class="form-control" type="file" name="image" id=""> <br>
            <label for="">Price:</label>
            <input class="form-control" type="text" name="price" id=""> <br>
            <label for="">Customer Name:</label>
            <select name="customers_id" class="form-control" id="">
                <?php foreach($customers as $customer): ?>
                    <option value="<?= $customer['customers_id'] ?>"><?= $customer['customers_name'] ?></option>
                <?php endforeach ?>    
            </select> <br>
            <input class="btn btn-primary" type="submit" value="Save">
            <input type="text" name="" id="">
        </form>
    </div>
</body>
</html>


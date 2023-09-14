<?php require_once 'list.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Danh sach</h2>
        <a class="btn btn-primary" href="add.php">Them moi</a>
        <table class="table text-center align-middle">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Customers Name</th>
                <th>Action</th>
            </tr>

            <?php foreach($data as $item): ?>
                <tr>
                    <th><?= $item['product_id'] ?></th>
                    <th><?= $item['product_name'] ?></th>
                    <th>
                        <img style="max-width: 100px;" src="<?= $item['image'] ?>" alt="">
                    </th>
                    <th><?= $item['price'] ?></th>
                    <th><?= $item['customers_name'] ?></th>
                    <th>
                        <a class="btn btn-primary" href="update.php?product_id=<?= $item['product_id'] ?>">Sửa</a>
                        <button class="btn btn-danger" onclick="if(confirm('Ban chac chua?')) window.location.href='delete.php?product_id=<?= $item['product_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>
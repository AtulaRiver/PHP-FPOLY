<?php
require_once 'list.php';
require_once 'check-login.php';
?>

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
        <?php if (isset($_SESSION['username'])) : ?>
            Welcome <b class='text-primary'><?= $_SESSION['username'] ?></b>
            <a class="link-danger" href="logout.php">Log Out</a>
        <?php endif ?>
        <h2>Danh Sách Giày</h2>
        <a class="btn btn-primary" href="add.php">Thêm Mới</a>
        <table class="table align-middle text-center">
            <tr>
                <th>ID</th>
                <th>Shoe Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>

            <?php foreach ($data as $item) : ?>
                <tr>
                    <th><?= $item['shoe_id'] ?> </th>
                    <th><?= $item['shoe_name'] ?> </th>
                    <th>
                        <img style="max-width: 100px; border-radius: 4px;" src="<?= $item['image'] ?>" alt="">
                    </th>
                    <th><?= $item['price'] ?> </th>
                    <th><?= $item['category_name'] ?> </th>
                    <th>
                        <a class="btn btn-primary" href="update.php?shoe_id=<?= $item['shoe_id'] ?>">Sửa</a>
                        <button class="btn btn-danger" onclick="if(confirm('Ban chac chua?')) window.location.href='delete.php?shoe_id=<?= $item['shoe_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>
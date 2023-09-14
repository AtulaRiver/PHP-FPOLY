<?php
    require_once 'check-login.php';
    require_once 'list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Danh Sách</h2>
        <a href="add.php" class="btn btn-primary">Thêm Mới</a>
        <table class="table text-center align-middle">
            <tr>
                <th>ID</th>
                <th>Flight Name</th>
                <th>Image</th>
                <th>Airline Name</th>
                <th>Total Passengers</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach($data as $item): ?>
                <tr>
                    <th><?= $item['flight_id'] ?></th>
                    <th><?= $item['flight_name'] ?></th>
                    <th>
                        <img src="<?= $item['img']?>" style="max-width: 100px;" alt="">
                    </th>
                    <th><?= $item['airline_name'] ?></th>
                    <th><?= $item['total_passengers'] ?></th>
                    <th><?= $item['description'] ?></th>
                    <th>
                        <a class="btn btn-primary" href="update.php?flight_id=<?= $item['flight_id'] ?>">Sửa</a>
                        <button class="btn btn-danger" onclick="if(confirm('Ban chac chua?'))
                        window.location.href='delete.php?flight_id=<?= $item['flight_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach ?>

        </table>
    </div>
</body>
</html>
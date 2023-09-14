<?php
    require_once 'list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <th>Flight Name</th>
                <th>Img</th>
                <th>Airline Name</th>
                <th>Total passengers</th>
                <th>Descroption</th>
                <th>Action</th>
            </tr>

            <?php foreach($data as $item): ?>
                <tr>
                    <th><?= $item['flight_id'] ?></th>
                    <th><?= $item['flight_name'] ?></th>
                    <th>
                        <img src="<?= $item['img'] ?>" style="max-width: 100px;" alt="">
                    </th>
                    <th><?= $item['airline_name'] ?></th>
                    <th><?= $item['total_passengers'] ?></th>
                    <th><?= $item['description'] ?></th>
                    <th>
                        <a href="update.php?flight_id=<?= $item['flight_id'] ?>" class="btn btn-primary">Sửa</a>
                        <button class='btn btn-danger' onclick="if(confirm('Ban chac chua?')) window.location.href='delete.php?flight_id=<?= $item['flight_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>
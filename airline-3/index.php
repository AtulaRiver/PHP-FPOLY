<?php
    require_once "list.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Danh sách chuyến bay</h2>
        <a href="./add.php" class="btn btn-primary">Thêm mới</a>
        <table class="table text-center align-middle">
            <tr>
                <th>ID</th>
                <th>Flight Number</th>
                <th>Image</th>
                <th>Total Passengers</th>
                <th>Airline Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach($data as $item): ?>
            <tr>
                    <th><?= $item['flight_id'] ?></th>
                    <th><?= $item['flight_number'] ?></th>
                    <th>
                        <img src="<?= $item['img'] ?>" alt="" style="max-width: 100px;">
                    </th>
                    <th><?= $item['total_passengers'] ?></th>
                    <th><?= $item['airline_name'] ?></th>
                    <th><?= $item['description'] ?></th>
                    <th>
                        <a href="update.php?flight_id=<?= $item['flight_id'] ?>" class="btn btn-primary">Sửa</a>

                        <button class="btn btn-danger" onclick="if(confirm('Ban chac chua?')) window.location.href='delete.php?flight_id=<?= $item['flight_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>
<?php require_once 'controller/list.php' ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <style>
        tr,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>CRUD</h1>

    <a href="create.php">Thêm mới</a>

    <table border="1px" cellspacing="0">
        <tr>
            <td>Flight ID</td>
            <td>Flight Name</td>
            <td>Image</td>
            <td>Total Passengers</td>
            <td>Description</td>
            <td>Airline</td>
            <td>Action</td>
        </tr>

        <?php foreach ($data as $item) : ?>
            <tr>
                <td><?= $item['flight_id'] ?></td>
                <td><?= $item['flight_name'] ?></td>
                <td><img width="50" src="<?= $item['image'] ?>" alt=""></td>
                <td><?= $item['total_passenger'] ?></td>
                <td><?= $item['description'] ?></td>
                <td><?= $item['airline_name'] ?></td>
                <td>
                    <a href="edit.php?flight_id=<?= $item['flight_id'] ?>">Sửa</a>
                    <button type="button" onclick="if (confirm('Are you sure?'))
                                    window.location.href='controller/delete.php?flight_id=<?= $item['flight_id'] ?>'">Xóa</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
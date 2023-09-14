<?php
    require_once 'list.php';
    require_once 'check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Danh Sach</h2>
        <a href="add.php" class="btn btn-primary">Them moi</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>
        <table class="table align-middle text-center">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role Name</th>
                <th>Action</th>
            </tr>

            <?php foreach($data as $item): ?>
            <tr>
                <th><?= $item['user_id'] ?></th>
                <th><?= $item['user_email'] ?></th>
                <th><?= $item['user_firstname'] ?></th>
                <th><?= $item['user_lastname'] ?></th>
                <th><?= $item['role_name'] ?></th>
                <th>
                    <a class="btn btn-primary" href="update.php?user_id=<?= $item['user_id'] ?>">Sửa</a>
                    <button class="btn btn-danger" onclick="if(confirm('Ban chac chua?')) window.location.href='delete.php?user_id=<?= $item['user_id'] ?>'" >Xóa</button>
                </th>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>
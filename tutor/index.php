<?php
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
        <h2>Danh Sách Film</h2>
        <a class="btn btn-primary" href="add.php">Thêm Mới</a>
        <table class="table text-center align-middle">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Poster</th>
                <th>Overview</th>
                <th>Release Date</th>
                <th>Genre Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <th><?= $item['movie_id'] ?></th>
                    <th><?= $item['title'] ?></th>
                    <th>
                        <img style="max-width: 100px;" src="<?= $item['poster'] ?>" alt="">
                    </th>
                    <th><?= $item['overview'] ?></th>
                    <th><?= $item['release_date'] ?></th>
                    <th><?= $item['genre_name'] ?></th>
                    <th>
                        <a class="btn btn-primary" href="update.php?movie_id=<?= $item['movie_id'] ?>">Sửa</a>
                        <button class="btn btn-danger" href="" onclick="if(confirm('Ban chac chua?'))
                        window.location.href='delete.php?movie_id=<?= $item['movie_id'] ?>'">Xóa</button>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
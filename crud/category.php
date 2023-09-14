<?php require_once "category/list.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <a href="./category/add.php" class="btn btn-primary">Thêm mới</a>
        <table class="table text-center">
            <div class="row">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Color</td>
                    <td>Action</td>
                </tr>

                <?php foreach ($categories as $item) : ?>
                    <tr>
                        <td><?= $item["id"] ?></td>
                        <td><?= $item["name"] ?></td>
                        <td><?= $item["color"] ?></td>
                        <td>
                            <a href="category/update.php?id=<?= $item['id'] ?>" class="btn btn-primary">Sửa</a>
                            <a href="javascript:;" onclick="if (confirm('Bạn chắc chưa ? ')) {
                                document.getElementById('delete-<?= $item['id'] ?>').submit()
                            }" class="btn btn-danger">Xóa</a>
                            <form action="category/delete.php" id="delete-<?= $item['id'] ?>">
                                <input type="hidden" name="id" value="<?= $item['id']?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </div>
        </table>
    </div>
    </div>
</body>

</html>
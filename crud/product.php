<?php require_once 'product/list.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRUD Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Danh sách Product</h1>

        <a href="product/add.php" class="btn btn-primary">Thêm mới</a>

        <div class="row">
            <table class="table text-center">
                <tr>
                    <td>ID</td>
                    <td>Ảnh</td>
                    <td>Tên</td>
                    <td>Danh mục</td>
                    <td>Hãng</td>
                    <td>Mô tả</td>
                    <td>Action</td>
                </tr>

                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td>
                            <img width="100px" src="product/<?= $product['anh'] ?>" alt="">
                        </td>
                        <td><?= $product['ten'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['hangsanxuat'] ?></td>
                        <td><?= $product['mota'] ?></td>
                        <td>
                            <a href="product/update.php?id=<?= $product['id'] ?>" class="btn btn-primary">Sửa</a>
                            <a href="javascript:;" onclick="if (confirm('Bạn chắc chưa ? ')) {
                                document.getElementById('delete-<?= $product['id'] ?>').submit()
                            }" class="btn btn-danger">Xóa</a>
                            <form action="product/delete.php" id="delete-<?= $product['id'] ?>">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>
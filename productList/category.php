<?php
require_once 'db/list.php';
require_once 'db/validate.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dee2e6;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
        }

        table {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <form method="post" action="./db/add.php" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="text-center mb-5">
                <h1>Quản lí sản phẩm</h1>
                <h2>Thêm sản phẩm</h2>
            </div>
            <div class="col-lg-4">
                <label for="" class="form-label">Category:</label> <br>
                <input type="text" class="form-control" name="category_id" id="" placeholder=""><span class="error"><?= $errorCategory ?? '' ?></span> <br>
               <label for="" class="form-label">Tên:</label>
                    <input type="text" class="form-control" name="name" id="" placeholder=""><span class="error"><?= $errorName ?? '' ?></span> <br>
                        <label for="" class="form-label">Ảnh: </label>
                        <input type="file" class="form-control" id="inputGroupFile02" name="image" accept=".png,.jpg,.jpeg"> <br>

            </div>

            <div class="col-lg-4">
                <label for="" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="floatingTextarea2" style="height: 224px" name="comment"></textarea><span class="error"><?= $errorComment ?? '' ?></span> <br> <br>
            </div>
            <div class="col-lg-8 text-center ms-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>
    <div class="container">

        <h1>Danh sách danh mục</h1>

        <div class="row">
            <table class="table">
                <tr>
                    <td>ID</td>
                    <td>Category</td>
                    <td>Name</td>
                    <td class="text-center">Ảnh</td>
                    <td>Mô tả</td>
                    <td>Action</td>
                </tr>

                <?php foreach ($stmt->fetchAll() as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['category_id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><img src="db/img/<?php echo $item['image']; ?>" alt="" style="width: 160px; height: 100px; margin: auto; display: flex"></td>
                        <td><?= $item['comment'] ?></td>
                        <td>
                            <a href="db/delete.php?id=<?= $item['id'] ?>" class="btn btn-danger" style="margin: auto">Xóa</a>
                            <a href="db/update.php?id=<?= $item['id'] ?>" class="btn btn-primary" style="margin: auto">Sửa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>
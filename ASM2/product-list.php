<?php
require 'connect.php';
require_once './edit/add.php';
require_once './edit/list.php';
require 'close.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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
    <form method="post" action="" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="text-center mb-5">
                <h1>Quản lí sản phẩm</h1>
                <h2>Thêm sản phẩm</h2>
            </div>
            <div class="col-lg-4">
                <label for="" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="ten" id="" placeholder="Product Name"> 
                <p class="text-danger"><?= $tenErr ?></p>
                <label for="" class="form-label">Hãng sản xuất:</label>
                <input type="text" class="form-control" name="hang" id="" placeholder="Manufacturer Name"> 
                <p class="text-danger"><?= $hangErr ?></p>
                <label for="" class="form-label">Giá:</label>
                <input type="text" class="form-control" name="gia" id="" placeholder="Price"> 
                <p class="text-danger"><?= $giaErr ?></p>
                <label for="" class="form-label">Ảnh: </label>
                <input type="file" class="form-control" name="img">
            </div>

            <div class="col-lg-4">
                <label for="" class="form-label">Thể loại:</label>
                <input type="text" class="form-control" name="theloai" id=""> 
                <p class="text-danger"><?= $theloaiErr ?></p>
                <label for="" class="form-label">Tính năng:</label> <br>
                <select class="form-control js-example-basic-multiple" name="tinhnang_id" multiple="multiple">
                    <?php foreach ($tinhnangs as $tinhnang) : ?>
                        <option value="<?= $tinhnang["tinhnang_id"] ?>"><?= $tinhnang["tinhnang_name"] ?></option>
                    <?php endforeach ?>
                </select>
                <p class="text-danger"><?= $tinhnang_idErr ?></p>
                 
                <label for="" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="floatingTextarea2" name="mota" style="height: 140px"></textarea> <br> <br>
            </div>
            <div class="col-lg-8 text-center ms-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

    <div class="container mt-5">
        <h3>Danh sách sản phẩm</h3> <br>
        <table class="table text-center align-middle">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hãng sản xuất</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Tính năng</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sanphams as $sanpham) : ?>
                    <tr>
                        <th><?= $sanpham['id'] ?></th>
                        <td>
                            <img style="max-width: 100px;" src="<?= $sanpham['img'] ?>" alt="">
                        </td>
                        <td><?= $sanpham['ten'] ?></td>
                        <td><?= $sanpham['hang'] ?></td>
                        <td><?= $sanpham['gia'] ?></td>
                        <td><?= $sanpham['theloai'] ?></td>
                        <td>
                            <?= $sanpham['tinhnang_name'] ?>
                        </td>
                        <td><?= $sanpham['mota'] ?></td>
                        <td>
                            <a href="update.php?id=<?= $sanpham['id'] ?>" class="btn btn-primary">Sửa</a>
                            <a href="javascript:;" onclick="if (confirm('Bạn chắc chưa ? ')) {
                                document.getElementById('delete-<?= $sanpham['id'] ?>').submit()
                            }" class="btn btn-danger">Xóa</a>
                            <form action="edit/delete.php" id="delete-<?= $sanpham['id'] ?>">
                                <input type="hidden" name="id" value="<?= $sanpham['id'] ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


</html>
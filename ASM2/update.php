<?php

require_once "connect.php";

try {
    $sql1 = 'select * from sanpham';
    $stmt = $conn->prepare($sql1);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sanpham = $stmt->fetch();

    $sql2 = 'select * from tinhnang';
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tinhnang = $stmt->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $ten = $_POST["ten"];
    $hang = $_POST["hang"];
    $gia = $_POST["gia"];
    $img = $_FILES["img"];
    $theloai = $_POST["theloai"];
    $tinhnang_id = $_POST["tinhnang_id"];
    $old_img = $_POST["old_img"];
    $mota = $_POST["mota"];

    try {
        $sql = 'update sanpham 
        set
        ten = :ten,
        hang = :hang,
        gia = :gia,
        img = :img,
        theloai = :theloai,
        tinhnang_id = :tinhnang_id,
        mota = :mota
        where id = :id;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ten", $ten);
        $stmt->bindParam(":hang", $hang);
        $stmt->bindParam(":gia", $gia);
        $stmt->bindParam(":theloai", $theloai);
        $stmt->bindParam(":tinhnang_id", $tinhnang_id);
        $stmt->bindParam(":mota", $mota);

        $imgFile = "edit/img/" . time() . $img["name"];
        move_uploaded_file($img["tmp_name"], $imgFile);

        $stmt->bindParam(":img", $imgFile);

        $stmt->execute();
        header("Location: product-list.php");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
require_once "close.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                <h2>Sửa sản phẩm</h2>
            </div>
            <div class="col-lg-4">
                <input type="hidden" name="id" value="<?= $sanpham['id'] ?>">
                <label for="" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="ten" id="" value="<?= $sanpham['ten'] ?>"> <br>
                <label for="" class="form-label">Hãng sản xuất:</label>
                <input type="text" class="form-control" name="hang" id="" value="<?= $sanpham['hang'] ?>"> <br>
                <label for="" class="form-label">Giá:</label>
                <input type="text" class="form-control" name="gia" id="" value="<?= $sanpham['gia'] ?>"> <br>
                <label for="" class="form-label">Ảnh: </label>
                <input type="file" class="form-control" name="img">
                <img src="edit/<?= $sanpham['img'] ?>" style="max-width: 200px;" alt="">
            </div>

            <div class="col-lg-4">
                <label for="" class="form-label">Thể loại:</label>
                <input type="text" class="form-control" name="theloai" value="<?= $sanpham['theloai'] ?>"> <br>
                <label for="" class="form-label">Tính năng:</label> <br>
                <select class="form-control js-example-basic-multiple" name="tinhnang_id" multiple="multiple">
                    <?php foreach ($tinhnang as $tn) : ?>
                        <option <?php if ($tn['tinhnang_id'] == $sanpham['tinhnang_id']) : ?> selected <?php endif ?> value="<?= $tn["tinhnang_id"] ?>"><?= $tn["tinhnang_name"] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br> <br>
                <label for="" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="floatingTextarea2" name="mota" style="height: 132px"><?= $sanpham['mota'] ?></textarea> <br> <br>
            </div>
            <div class="col-lg-8 text-center ms-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>
    </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

</html>
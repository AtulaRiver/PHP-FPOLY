<?php
require_once "../connect.php";

$tenErr = $hangErr = $motaErr = $category_idErr = $anhErr = null;

try {
    $sql = '
        select id, name from categories;
        ';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $categories = $stmt->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ten = $_POST["ten"];
    $mota = $_POST["mota"];
    $hangsanxuat = $_POST["hangsanxuat"];
    $anh = $_FILES["anh"];
    $category_id = $_POST["category_id"];
    
    if (empty($ten)) {
        $tenErr = 'Trường tên là bắt buộc';
    }

    if (empty($category_id)) {
        $category_idErr = 'Trường danh mục là bắt buộc';
    }

    if (strlen($hangsanxuat) > 255) {
        $hangErr = 'Trường hãng tối đa 255 ký tự';
    }

    if (strlen($mota) > 10000) {
        $motaErr = 'Trường mô tả tối đa 10000 ký tự';
    }

    if (empty($anh['name'])) {
        $anhErr = 'Trường ảnh tối đa 2MB';
    }

    if (
        empty($tenErr)
        && empty($hangErr)
        && empty($motaErr)
        && empty($category_idErr)
        && empty($anhErr)
    ) {

        try {
            $sql = '
                insert into products(ten, mota, hangsanxuat, anh, category_id)
                values (:ten, :mota, :hangsanxuat, :anh, :category_id);
            ';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":ten", $ten);
            $stmt->bindParam(":mota", $mota);
            $stmt->bindParam(":hangsanxuat", $hangsanxuat);
            $stmt->bindParam(":category_id", $category_id);

            $imgFile = 'img/' . time() . $anh['name'];
            move_uploaded_file($anh['tmp_name'], $imgFile);
            $stmt->bindParam(":anh", $imgFile);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        header("Location: ../product.php");
    }
}

require_once "../close.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Thêm Mới Danh mục</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="ten">
                <p style="color: red"><?= $tenErr ?></p>
            </div>
            <div class="mb-3">
                <label for="anh">Ảnh:</label>
                <input type="file" class="form-control" id="anh" name="anh">
                <p style="color: red"><?= $anhErr ?></p>
            </div>
            <div class="mb-3">
                <label for="hsx">Hãng sản xuất: </label>
                <input type="text" class="form-control" id="hsx" name="hangsanxuat">
                <p style="color: red"><?= $hangErr ?></p>
            </div>
            <div class="mb-3">
                <label for="cmt">Mô tả:</label>
                <textarea name="mota" id="" class="form-control" cols="30" rows="10"></textarea>
                <p style="color: red"><?= $motaErr ?></p>
            </div>
            <div class="mb-3">
                <label for="anh">Tên category:</label>
                <select class="form-control" name="category_id" id="cate_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <p style="color: red"><?= $category_idErr ?></p>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</body>

</html>
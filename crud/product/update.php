<?php

require_once "../connect.php";

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
function getID($conn, $id)
{
    try {
        $sql = '
            select * from products where id = :id;
        ';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
};

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $model = getID($conn, $id);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $ten = $_POST["ten"];
    $mota = $_POST["mota"];
    $hangsanxuat = $_POST["hangsanxuat"];
    $anh = $_FILES["anh"];
    $category_id = $_POST["category_id"];

    $model = getID($conn, $id);

    if (empty($model)) {
        die('khong ton tai ID');
    }

    $sql = '
        update products 
        set ten = :ten,
        mota = :mota,
        hangsanxuat = :hangsanxuat,
        anh = :anh,
        category_id = :category_id
        where id = :id;
    ';

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(":ten", $ten);
        $stmt->bindParam(":mota", $mota);
        $stmt->bindParam(":hangsanxuat", $hangsanxuat);
        $stmt->bindParam(":category_id", $category_id);

        $imgFile = 'img/' . time() . $anh['name'];
        move_uploaded_file($anh['tmp_name'], $imgFile);
        $stmt->bindParam(":anh", $imgFile);

        $stmt->execute();
    } catch (PDOException $PDOException) {
        die($PDOException->getMessage());
    }
    header("Location: ../product.php");
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
            <input type="hidden" name="id" value="<?= $model['id'] ?>">
            <div class="mb-3 mt-3">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="ten" value="<?= $model["ten"] ?>">
            </div>
            <div class="mb-3">
                <label for="anh">Ảnh:</label>
                <input type="file" class="form-control" id="anh" name="anh">
            </div>
            <div class="mb-3">
                <label for="hsx">Hãng sản xuất: </label>
                <input type="text" class="form-control" id="hsx" name="hangsanxuat" value="<?= $model["hangsanxuat"] ?>">
            </div>
            <div class="mb-3">
                <label for="cmt">Mô tả:</label>
                <textarea name="mota" id="" class="form-control" cols="30" rows="10"><?= $model["mota"] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="anh">Tên category:</label>
                <select class="form-control" name="category_id" id="cate_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</body>

</html>
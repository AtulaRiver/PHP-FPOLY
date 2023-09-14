<?php
require_once "../connect-db.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];

    try {
        $sql = "
        select * from categories where id = :id;
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $model = $stmt->fetch();
    } catch (PDOException $e) {
        die($e->getMessage());
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $image = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $imgExtension = explode('.', $image);
    $imgExtension = strtolower(end($imgExtension));
    $newImageName = uniqid();
    $newImageName .= '.' . $imgExtension;

    move_uploaded_file($tmp_name, 'img/' . $newImageName);


    $sql = "
        update categories 
        set category_id = :category_id,
        name = :name,
        comment = :comment,
        image = :image
        where id = :id;
        ";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":comment", $comment);
        $stmt->bindParam(":image", $newImageName);
        $stmt->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    header("Location: ../category.php");
    
}

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
    <form method="post" action="" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="text-center mb-5">
                <h1>Quản lí sản phẩm</h1>
                <h2>Sửa sản phẩm</h2>
            </div>
            <div class="col-lg-4">
                <input type="hidden" name="id" value="<?= $model["id"] ?>">
                <label for="" class="form-label">Category:</label> <br>
                <input type="text" class="form-control" name="category_id" id="" value="<?= $model["category_id"] ?>"> <br>
                <label for="" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="name" id="" placeholder="" value="<?= $model["name"] ?>"> <br>
                <label for="" class="form-label">Ảnh: </label>
                <input type="file" class="form-control" id="" name="image" value="./img/<?= $model["image"] ?>"> <br>

            </div>

            <div class="col-lg-4">
                <label for="" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="" style="height: 224px" name="comment"><?= $model["comment"] ?></textarea> <br> <br>
            </div>
            <div class="col-lg-8 text-center ms-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

</body>

</html>

<?php
require_once "../close-db.php";

?>
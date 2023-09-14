<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class="row d-flex justify-content-center">
            <div class="text-center mb-5">
                <h1>Quản lí sản phẩm</h1>
                <h2>Thêm/Sửa sản phẩm</h2>
            </div>
            <div class="col-lg-4">
                <label for="" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="fn" id=""> <br>
                <label for="" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="ln" id=""> <br>
                <label for="" class="form-label">Tuổi:</label>
                <input type="text" class="form-control" name="age" id=""> <br>
            </div>
            <div class="col-lg-8 text-center ms-3 mt-5">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

    <h3>Danh sách sản phẩm</h3>

</body>

</html>

<?php
require_once 'assets/php/insert.php';

?>
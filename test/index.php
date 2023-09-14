<?php
    require_once 'connect.php';
    require_once 'list.php';
    require_once 'close.php';
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
        table {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table text-center mt-5">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Màu</th>
                <th>Action</th>
            </tr>

            <tr>
                <?php foreach($list as $item) :?>
                <th><?= $item['id']?></th>
                <th><?= $item['ten']?></th>
                <th>
                    <img src="<?= $item['anh']?>" alt="">
                </th>
                <th><?= $item['mau']?></th>
                <th>
                    <a href="edit.php?id=<?= $item['id']?>" class="btn btn-primary">Sửa</a>
                </th>
                <?php endforeach ?>
            </tr>
        </table>
    </div>
</body>

</html>
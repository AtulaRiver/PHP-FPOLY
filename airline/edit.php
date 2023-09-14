<?php require_once 'controller/edit.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>THÊM MỚI</title>
    <style>
    </style>
</head>
<body>
<h1>THÊM MỚI</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="flight_id" value="<?= $flight['flight_id'] ?>">
    <input type="hidden" name="old_image" value="<?= $flight['image'] ?>">
    <div class="input-group">
        <label for="flight_name">flight_name</label>
        <input type="text" name="flight_name" value="<?= $flight['flight_name'] ?>" id="flight_name">
    </div>
    <div class="input-group">
        <label for="image">image</label>
        <input type="file" name="image" id="image">
        <img width="50px" src="<?= $flight['image'] ?>" alt="">
    </div>
    <div class="input-group">
        <label for="total_passengers">total_passengers</label>
        <input type="number" value="<?= $flight['total_passenger'] ?>" name="total_passenger" id="total_passenger">
    </div>
    <div class="input-group">
        <label for="description">description</label>
        <textarea name="description" id="description"><?= $flight['description'] ?></textarea>
    </div>
    <div class="input-group">
        <label for="airline_id">airline_id</label>
        <select name="airline_id" id="airline_id">
            <?php foreach ($airlines as $item): ?>
                <option
                    <?php if ($item['airline_id'] == $flight['airline_id']): ?>
                    selected
                    <?php endif; ?>
                    value="<?= $item['airline_id'] ?>"><?= $item['airline_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Lưu</button>
</form>
</body>
</html>

<?php require_once 'controller/create.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>THÊM MỚI</title>

</head>
<body>
<h1>THÊM MỚI</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <label for="flight_name">flight_name</label>
        <input type="text" name="flight_name" id="flight_name">
        <p style="color: red;"><?= $flight_nameErr ?></p>
    </div>
    <div class="input-group">
        <label for="image">image</label>
        <input type="file" name="image" id="image">
    </div>
    <div class="input-group">
        <label for="total_passenger">total_passengers</label>
        <input type="number" name="total_passenger" id="total_passenger">
        <p style="color: red;"><?= $total_passengerErr ?></p>
    </div>
    <div class="input-group">
        <label for="description">description</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div class="input-group">
        <label for="airline_id">airline_id</label>
        <select name="airline_id" id="airline_id">
            <?php foreach ($airlines as $item): ?>
            <option value="<?= $item['airline_id'] ?>"><?= $item['airline_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <p style="color: red;"><?= $airline_idErr ?></p>
    </div>
    <button type="submit">Lưu</button>
</form>
</body>
</html>

<?php
require_once 'connect.php';

try {
    $sql = "select * from genres";
    $genres = $conn->query($sql)->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $poster = $_FILES['poster'];
    $overview = $_POST['overview'];
    $release_date = $_POST['release_date'];
    $genre_id = $_POST['genre_id'];

    try {
        $sql = "insert into movies(
                title,
                poster,
                overview,
                release_date,
                genre_id
            ) values (
                :title,
                :poster,
                :overview,
                :release_date,
                :genre_id
            );";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':overview', $overview);
        $stmt->bindParam(':release_date', $release_date);
        $stmt->bindParam(':genre_id', $genre_id);
        $imgFile = 'img/' . time() . $poster['name'];
        move_uploaded_file($poster['tmp_name'], $imgFile);

        $stmt->bindParam(':poster', $imgFile);

        $stmt->execute();

        header("Location: index.php");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
require_once 'close.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Title:</label>
            <input type="text" class="form-control" name="title" id=""> <br>
            <label for="">Poster:</label>
            <input type="file" class="form-control" name="poster" id=""> <br>
            <label for="">Release Date:</label>
            <input type="date" class="form-control" name="release_date" id=""> <br>
            <label for="">Genre Name:</label>
            <select class="form-control" name="genre_id" id="">
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= $genre['genre_id'] ?>"><?= $genre['genre_name'] ?></option>
                <?php endforeach ?>
            </select> <br>
            <label for="">Overview:</label>
            <textarea class="form-control" name="overview" id="" cols="30" rows="10"></textarea><br>
            <input class="btn btn-primary" type="submit" value="Lưu">
        </form>
    </div>
</body>

</html>
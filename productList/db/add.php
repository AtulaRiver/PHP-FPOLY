<?php
require_once "../connect-db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $image = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $imgExtension = explode('.', $image);
    $imgExtension = strtolower(end($imgExtension));
    $newImageName = uniqid();
    $newImageName .= '.' .$imgExtension;
    move_uploaded_file($tmp_name, 'img/'. $newImageName);


    $sql = "
        insert into categories(category_id, name, comment, image)
        values 
        (:category_id, :name, :comment, :image);
        ";

    try {
        $stmt = $conn->prepare($sql);
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

require_once "../close-db.php";

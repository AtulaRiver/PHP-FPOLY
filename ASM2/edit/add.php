<?php

$tenErr = $hangErr = $giaErr = $theloaiErr = $tinhnang_idErr = $motaErr = null;

try {
    $sql = "
        select tinhnang_id, tinhnang_name
        from tinhnang
        ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tinhnangs = $stmt->fetchAll();
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ten = $_POST["ten"];
    $hang = $_POST["hang"];
    $gia = $_POST["gia"];
    $img = $_FILES["img"];
    $theloai = $_POST["theloai"];
    $tinhnang_id = $_POST["tinhnang_id"] ?? null;
    $mota = $_POST["mota"];

    if(empty($ten)) {
        $tenErr = "* Xin hãy nhập tên!";
    }

    if(empty($hang)) {
        $hangErr = "* Xin hãy nhập hãng sản xuất!";
    }

    if(empty($gia)) {
        $giaErr = "* Xin hãy nhập giá!";
    }

    if(empty($theloai)) {
        $theloaiErr = "* Xin hãy thể loại!";
    }
    if(empty($tinhnang_id)) {
        $tinhnang_idErr = "* Xin hãy chọn tính năng!";
    }
    if (empty($tenErr) 
    && empty($hangErr) 
    && empty($giaErr) 
    && empty($theloaiErr) 
    && empty($tinhnang_idErr)) {
        try {
            $sql = '
                    insert into sanpham(ten, hang, gia, img, theloai, tinhnang_id, mota)
                    values 
                    (:ten, :hang, :gia, :img, :theloai, :tinhnang_id, :mota)
                ';
    
            $stmt = $conn->prepare($sql);
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
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}


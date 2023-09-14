<?php
    $sql = '
        select s.id, s.ten, s.hang, s.gia, s.img, s.theloai, s.mota, t.tinhnang_name
        from sanpham as s
        inner join tinhnang as t on t.tinhnang_id = s.tinhnang_id;
    ';

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $sanphams = $stmt -> fetchAll();

    } catch (PDOException $e) {
        die($e->getMessage());
    }

?>
<?php 
    require_once 'connect.php';
    try {
        $sql = "select m.movie_id, m.title, m.poster, m.overview, m.release_date, m.genre_id, g.genre_name from movies as m
        inner join genres as g on g.genre_id = m.genre_id";
        $data = $conn -> query($sql) -> fetchAll();
    } catch(PDOException $e) {  
        die($e -> getMessage());
    }

    require_once 'close.php';
?>  
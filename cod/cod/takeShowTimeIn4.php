<?php
include "connectToDatabase.php";

// Truy vấn kết hợp bảng tblshowtime và tblmovie
$sql = "SELECT s.showtime_id, s.thoiGian, s.date, s.movie_id, m.movie_name, m.image_movie 
        FROM tblshowtime s
        JOIN tblmovie m ON s.movie_id = m.movie_id";
$result = $conn->query($sql);
?>
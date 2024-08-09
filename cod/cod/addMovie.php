<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPhim = $_POST['idPhim'];
    $tenPhim = $_POST['tenPhim'];
    $fileImage = $_POST['fileImage'];
    $Mota = $_POST['Mota'];
    $thoiLuong = $_POST['thoiLuong'];
    $daoDien = $_POST['daoDien'];
    $ngayChieu = $_POST['ngayChieu'];
    $phongChieu = $_POST['phongChieu'];
    $status = $_POST['status'];
    $price = $_POST['price'];

    $checkSql = "SELECT COUNT(*) as count FROM tblmovie WHERE movie_id='$idPhim'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Error: Movie ID already exists.";
    } else {
        $sql = "INSERT INTO tblmovie (movie_id, movie_name, image_movie, describe_movie, thoiLuong, daoDien, screen_id, date, status_movie, price)
                VALUES ('$idPhim', '$tenPhim', '$fileImage', '$Mota', '$thoiLuong', '$daoDien', '$phongChieu', '$ngayChieu', '$status', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

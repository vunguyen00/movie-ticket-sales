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

    if (empty($idPhim)) {
        echo "Error: Movie's id is required.";
        exit;
    }

    $checkSql = "SELECT COUNT(*) as count FROM tblmovie WHERE movie_id=?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $idPhim);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        echo "Error: Movie id does not exist.";
    } else {
        $updateSql = "UPDATE tblmovie SET movie_name=?, image_movie=?, describe_movie=?, thoiLuong=?, daoDien=?, date=?, screen_id=?, status_movie=?, price=? WHERE movie_id=?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("sssissisii", $tenPhim, $fileImage, $Mota, $thoiLuong, $daoDien, $ngayChieu, $phongChieu, $status, $price, $idPhim);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Movie updated successfully";
            } else {
                echo "Error: Failed to update the movie.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

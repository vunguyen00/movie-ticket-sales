<?php
include "connectToDatabase.php";

// Kiểm tra nếu có dữ liệu được gửi từ form POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra và lấy tên phim từ biến $_POST
    $tenPhim = $_POST['idPhim'];

    // Validate input
    if (empty($tenPhim)) {
        echo "Error: Movie id is required.";
        exit;
    }

    // Sử dụng prepared statement để tránh SQL injection
    $checkSql = "SELECT COUNT(*) as count FROM tblmovie WHERE movie_id=?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $tenPhim);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch(); 
    $stmt->close();

    if ($count == 0) {
        echo "Error: Movie name does not exist. TenPhim: " . $tenPhim;
    }
     else {
        // Delete the movie record using prepared statement
        $deleteSql = "DELETE FROM tblmovie WHERE movie_id=?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("s", $tenPhim);

        if ($stmt->execute()) {
            if ($conn->affected_rows > 0) {
                echo "Movie deleted successfully";
            } else {
                echo "Error: Failed to delete the movie.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<?php
include 'connectToDatabase.php';

$movie_name = isset($_GET['movie_name']) ? $_GET['movie_name'] : '';

// Bảo vệ dữ liệu nhập từ URL nếu có
if ($movie_name) {
    $movie_name = mysqli_real_escape_string($conn, $movie_name);

    // Lấy movie_id, image_movie, status_movie, và screen_id từ tblmovie dựa trên movie_name
    $stmt = $conn->prepare("SELECT movie_id, image_movie, status_movie, screen_id FROM tblmovie WHERE movie_name = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $movie_name);
    $stmt->execute();
    $stmt->bind_result($movie_id, $image_movie, $status_movie, $screen_id);
    $stmt->fetch();
    $stmt->close();
}

// Kiểm tra nếu movie_id tồn tại và lấy dữ liệu từ tblshowtime dựa trên movie_id
if (isset($movie_id)) {
    $stmt = $conn->prepare("SELECT date, thoiGian FROM tblshowtime WHERE movie_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $showtimes = [];
    while ($row = $result->fetch_assoc()) {
        $date = $row['date'];
        $thoiGian = $row['thoiGian'];
        if (!isset($showtimes[$date])) {
            $showtimes[$date] = [];
        }
        $showtimes[$date][] = $thoiGian;
    }
    $stmt->close();
} else {
    // Nếu không có movie_name hoặc movie_id không tồn tại, lấy toàn bộ thông tin từ tblshowtime và tblmovie
    $stmt = $conn->prepare("SELECT tblmovie.movie_name, tblmovie.image_movie, tblshowtime.thoiGian, tblshowtime.date, tblmovie.screen_id
                            FROM tblshowtime 
                            JOIN tblmovie ON tblshowtime.movie_id = tblmovie.movie_id");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $showtimes = [];
    while ($row = $result->fetch_assoc()) {
        $movie_name = $row['movie_name'];
        $image_movie = $row['image_movie'];
        $date = $row['date'];
        $thoiGian = $row['thoiGian'];
        $screen_id = $row['screen_id'];
        if (!isset($showtimes[$movie_name][$date])) {
            $showtimes[$movie_name][$date] = [];
        }
        $showtimes[$movie_name][$date][] = $thoiGian;
    }
    $stmt->close();
}

$conn->close();
?>
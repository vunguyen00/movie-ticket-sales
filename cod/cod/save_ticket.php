<?php
session_start();
if (!isset($_SESSION['userName'])) {
    die(json_encode(['success' => false, 'message' => 'Bạn phải đăng nhập để đặt vé']));
}

include "connectToDatabase.php";
$data = $_SESSION['booking_details'];

if ($data === null) {
    die(json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']));
}

$seats = $data['seats'] ?? [];
if (empty($seats)) {
    die(json_encode(['success' => false, 'message' => 'Không có ghế nào được chọn']));
}

$food = json_encode($data['food']);
$total_price = floatval(str_replace(',', '', explode(' ', $data['total_price'])[0]));
$userName = $_SESSION['userName'];

$sql_movie = "SELECT movie_id FROM tblmovie WHERE movie_name = ?";
$stmt_movie = $conn->prepare($sql_movie);
$stmt_movie->bind_param("s", $data['movie_name']);
$stmt_movie->execute();
$result_movie = $stmt_movie->get_result();
if ($result_movie === false || $result_movie->num_rows === 0) {
    die(json_encode(['success' => false, 'message' => 'Không tìm thấy thông tin phim hoặc lỗi truy vấn']));
}

$movie = $result_movie->fetch_assoc();
$movie_id = $movie['movie_id'];
$screen_id = $data['screen_id'];
$date = $data['date'];
$time = $data['time'];

$conn->begin_transaction();

try {
    foreach ($seats as $seat) {
        $sql_ticket = $conn->prepare("INSERT INTO tblticket (userName, movie, date, time, seat, food, total_price) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($sql_ticket === false) {
            throw new Exception('Lỗi chuẩn bị câu truy vấn: ' . $conn->error);
        }

        $sql_ticket->bind_param("sissssd", $userName, $movie_id, $date, $time, $seat, $food, $total_price);
        if ($sql_ticket->execute() === false) {
            throw new Exception('Lỗi chèn dữ liệu vào bảng tblticket: ' . $sql_ticket->error);
        }

        $sql_seat = $conn->prepare("UPDATE tblseat SET status='unavailable' WHERE seat_name=?");
        if ($sql_seat === false) {
            throw new Exception('Lỗi chuẩn bị câu truy vấn cập nhật ghế: ' . $conn->error);
        }

        $sql_seat->bind_param("s", $seat);
        if ($sql_seat->execute() === false) {
            throw new Exception('Lỗi cập nhật trạng thái ghế: ' . $sql_seat->error);
        }
    }

    $sql_update_revenue = $conn->prepare("UPDATE tblmovie SET doanhThu = doanhThu + ? WHERE movie_id = ?");
    if ($sql_update_revenue === false) {
        throw new Exception('Lỗi chuẩn bị câu truy vấn cập nhật doanh thu: ' . $conn->error);
    }
    
    $sql_update_revenue->bind_param("di", $total_price, $movie_id);
    if ($sql_update_revenue->execute() === false) {
        throw new Exception('Lỗi cập nhật doanh thu: ' . $sql_update_revenue->error);
    }
    
    $conn->commit();

    // Lưu dữ liệu vào session để sendEmail.php sử dụng
    $_SESSION['email_booking_details'] = [
        'user_name' => $userName,
        'movie_name' => $data['movie_name'],
        'screen_id' => $screen_id,
        'date' => $date,
        'time' => $time,
        'seats' => $seats,
        'food' => json_decode($food, true),
        'total_price' => number_format($total_price, 0, ',', ',') . ' VNĐ'
    ];

    // Gọi sendEmail.php
    include 'sendEmail.php';

} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>

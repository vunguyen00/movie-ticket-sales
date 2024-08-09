<?php
$bookingDetails = $_SESSION['email_booking_details'] ?? null;

if ($bookingDetails === null) {
    die('Dữ liệu không hợp lệ');
}

// Kiểm tra dữ liệu nhận được
error_log(print_r($bookingDetails, true));

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kết nối cơ sở dữ liệu
require 'connectToDatabase.php';

// Lấy tên người dùng từ session
$userName = $_SESSION['userName'] ?? '';

if (empty($userName)) {
    die('User not logged in.');
}

// Truy vấn để lấy địa chỉ email từ bảng tbluser
$sql = "SELECT email FROM tbluser WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt->bind_result($userEmail);
$stmt->fetch();
$stmt->close();

if (!$userEmail) {
    die('Không tìm thấy địa chỉ email cho người dùng này.');
}
$bookingCode = uniqid();

// Chèn dữ liệu vào bảng tblbill
$sql = "INSERT INTO tblbill (user, code, movie_name, seat, total) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$seats = implode(', ', $bookingDetails['seats']);
$totalPrice = htmlspecialchars($bookingDetails['total_price']);
$stmt->bind_param("ssssd", $bookingDetails['user_name'], $bookingCode, $bookingDetails['movie_name'], $seats, $totalPrice);

if (!$stmt->execute()) {
    die('Lỗi khi lưu hóa đơn vào cơ sở dữ liệu: ' . $stmt->error);
}
$stmt->close();

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nguyenvu00304@gmail.com'; // Thay bằng email của bạn
    $mail->Password = 'ojss bihy qyrb wlrf'; // Thay bằng mật khẩu email của bạn
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('nguyenvu00304@gmail.com', 'RAP CHIEU PHIM');
    $mail->addAddress($userEmail);

    $mail->isHTML(true);
    $mail->Subject = 'Hóa đơn đặt vé';
    $mail->Body    = '
        <h1>Hóa đơn đặt vé</h1>
        <p>Người đặt: ' . htmlspecialchars($bookingDetails['user_name']) . '</p>
        <p>Tên phim: ' . htmlspecialchars($bookingDetails['movie_name']) . '</p>
        <p>Ngày chiếu: ' . htmlspecialchars($bookingDetails['date']) . '</p>
        <p>Giờ chiếu: ' . htmlspecialchars($bookingDetails['time']) . '</p>
        <p>Ghế: ' . implode(', ', array_map('htmlspecialchars', $bookingDetails['seats'])) . '</p>
        <p>Thức ăn: 
            <ul>';
    foreach ($bookingDetails['food'] as $food => $quantity) {
        $mail->Body .= '<li>' . htmlspecialchars($food) . ': ' . htmlspecialchars($quantity) . '</li>';
    }
    $mail->Body .= '</ul></p>
        <p>Tổng giá: ' . htmlspecialchars($bookingDetails['total_price']) . '</p>
        <p>Mã đặt vé: ' . uniqid() . '</p>';

    $mail->send();
    echo '<script type="text/javascript">
        alert("Hóa đơn đã được gửi!");
        window.location.href = "index.php";
      </script>';
} catch (Exception $e) {
    error_log('Mailer Error: ' . $mail->ErrorInfo);
    die('Mailer Error: ' . $mail->ErrorInfo);
}

$conn->close();
?>

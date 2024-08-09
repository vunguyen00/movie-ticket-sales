<?php
session_start();

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Kết nối cơ sở dữ liệu
require 'connectToDatabase.php';

// Lấy email từ form đầu vào
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['forgotEmail'];

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT email FROM tbluser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Tạo liên kết đặt lại mật khẩu
        $resetLink = "http://localhost:3000/cod/reset_password.php?email=" . urlencode($email);

        try {
            //Server settings
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Bật debug
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'concoko35@gmail.com';
            $mail->Password = 'cbdt bque lzxt pztk'; // Lưu ý: Không nên lưu mật khẩu trực tiếp trong mã nguồn
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('concoko35@gmail.com', 'Your Name');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body    = 'Click <a href="' . $resetLink . '">here</a> to reset your password.';
            $mail->AltBody = 'Copy and paste this link into your browser: ' . $resetLink;

            $mail->send();
            echo "Mail đã gửi thành công!";
        } catch (Exception $e) {
            echo "Message chưa được gửi. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Không tìm thấy email trong db";
    }

    $stmt->close();
    $conn->close();
}
?>

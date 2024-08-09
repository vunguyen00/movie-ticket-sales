<?php
session_start();
require 'connectToDatabase.php';

$message = "";
$is_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $sql = "UPDATE tbluser SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute()) {
        $message = "Mật khẩu đã được cập nhật thành công!";
        $is_success = true;
    } else {
        $message = "Có lỗi xảy ra. Vui lòng thử lại. Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            background-image: url('images/bgr.jpg'); 
            background-size: cover;
            background-color: solid #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 400px;
            animation: fadeIn 1.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .message {
            margin: 20px 0;
            font-size: 18px;
            color: green;
        }
        .error {
            margin: 20px 0;
            font-size: 18px;
            color: red;
        }
        a {
            display: inline-block;
            width: 80%;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="<?php echo $is_success ? 'message' : 'error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php if ($is_success): ?>
            <a href="login.php">Quay lại trang đăng nhập</a>
        <?php endif; ?>
    </div>
</body>
</html>

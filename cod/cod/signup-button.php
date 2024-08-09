<?php
include 'connectToDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if ($password != $repassword) {
        echo "Passwords không giống!";
        exit;
    }

    // Check password 
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/_/', $password)) {
        echo "Mật khẩu phải dài ít nhất 8 ký tự, có dấu gạch dưới (_) và có ít nhất một chữ in hoa!";
        exit;
    }

    // Check email 
    $stmt = $conn->prepare("SELECT user_id FROM tbluser WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email đã tồn tại!";
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO tbluser (email, username, password, token, leveluser) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $email, $name, $hashed_password, $password);

    if ($stmt->execute()) {
        echo "Đăng ký thành công";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

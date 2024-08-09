<?php
session_start();
require 'connectToDatabase.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT email FROM tbluser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Email tồn tại trong cơ sở dữ liệu
    } else {
        echo "Link đặt lại mật khẩu không hợp lệ.";
        exit();
    }
} else {
    echo "Không tìm thấy email.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
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
        .form-signin {
        text-align: center;
        }

        .form-signin h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
            font-weight: bold;
        }
        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 80%;
            padding: 12px 40px;
            border: 1px solid #ccc;
            border-radius: 50px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-box input:focus {
            border-color: #2193b0;
            box-shadow: 0 0 8px rgba(33, 147, 176, 0.6);
        }

        .input-box i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #2193b0;
            font-size: 20px;
        }
        button {
            width: 50%;
            padding: 12px;
            border: none;
            background: #d441e8;
            color: #fff;
            font-size: 18px;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background: #db501e;
            box-shadow: 0 10px 20px rgba(178, 11, 208, 0.4);
        }

        
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="from-signin">
        <h2>Reset Password</h2>
        <form action="update_password.php" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required >
                <i class='bx bx-lock'></i>
            </div>
            <div class="input-box">
                <input type="password" name="repassword" id="repassword" placeholder="Confirm Password" required>
                <i class='bx bx-lock'></i>
            </div>
            <button type="submit">Reset Password</button>
        </form>
        </div>
    </div>
</body>
</html>

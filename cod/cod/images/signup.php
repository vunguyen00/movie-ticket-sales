<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel = "stylesheet" href = "../css/signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-signup">
            <form action="signup.php" method="post">
                <h1>
                    Sign Up
                </h1>
                <div class="input-box">
                    <input type="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class='bx bx-lock'></i>
                </div>
                <button type="submit">Sign Up</button>
                <div class="login-link">
                    <p>Đã có tài khoản?<a href="login.html" class="loginbtn">Đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

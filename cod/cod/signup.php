
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-signin">
            <form action="signup-button.php" method="post">
                <h1>Sign Up</h1>
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <i class='bx bxl-github'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class='bx bx-lock'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="repassword" id="repassword" placeholder="Confirm Password" required>
                    <i class='bx bx-lock'></i>
                </div>
                <button type="submit" name="submit">Sign Up</button>
                <div class="login-link">
                    <p>Đã có tài khoản?<a href="login.php" class="loginbtn">Đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

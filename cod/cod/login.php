
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-signin"> 
            <form action="login_submit.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required id="email">
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required id="password">
                    <i class='bx bx-lock'></i>
                </div>
                <button type="submit">Login</button>
                <div class="forgot-password">
                    <a href="#" id="forgotPasswordBtn">Quên mật khẩu?</a>
                </div>
                <div class="signUp-link">
                    <p>Không có tài khoản?<a href="signup.php" class="signUpbtn">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- forgot password Popup -->
    <div id="forgotPasswordPopup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Quên mật khẩu</h2>
            <form action="forgot_password.php" method="post">
                <div class="input-box">
                    <input type="email" name="forgotEmail" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <button type="submit">Xác nhận</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var forgotPasswordBtn = document.getElementById("forgotPasswordBtn");
            var forgotPasswordPopup = document.getElementById("forgotPasswordPopup");
            var closeBtn = document.querySelector(".close-btn");

            forgotPasswordBtn.addEventListener("click", function(event) {
                event.preventDefault();
                forgotPasswordPopup.style.display = "block";
            });

            closeBtn.addEventListener("click", function() {
                forgotPasswordPopup.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == forgotPasswordPopup) {
                    forgotPasswordPopup.style.display = "none";
                }   
            });
        });
    </script>
</body>
</html>

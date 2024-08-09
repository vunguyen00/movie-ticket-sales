<?php
include "connectToDatabase.php";
session_start();
function isLoggedIn() {
    return isset($_SESSION['userName']);
}
function getCurrentUrl() {
    return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = getCurrentUrl();
}
if (isset($_GET['movie_name'])) {
    $movie_name = $_GET['movie_name'];
    $sql = "SELECT * FROM tblmovie WHERE movie_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi khi chuẩn bị câu lệnh SQL: " . $conn->error);
    }
    $stmt->bind_param("s", $movie_name);
    $stmt->execute();
    $result = $stmt->get_result();  

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "No movie found";
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No movie name provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Chi Tiết Phim</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script>
    function checkLogin(event, movieName) {
        <?php if (!isLoggedIn()): ?>
            event.preventDefault();
            alert('Please log in to book tickets.');
            window.location.href = 'login.php?redirect_url=' + encodeURIComponent(window.location.href + '&movie_name=' + movieName);
        <?php endif; ?>
    }
    </script>
</head>
<body background="" style="background-color: brown;">
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">
                    <div class="viTri">
                        <a href="index.php"><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>
                        </div>
                        <div class="searchAndLogin">
                            <div class="searchIcon">
                                <div class="search-container">
                                    <input type="text" placeholder="Tìm kiếm">
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85a1.007 1.007 0 0 0-.115-.098zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <?php if (isLoggedIn()): ?>
                                    <div class="dropdown" style="display:flex;">
                                        <p style="color:aqua; cursor:pointer;"><?php echo htmlspecialchars($_SESSION['userName']); ?></p>
                                        <div class="dropdown-content">
                                            <a href="profile.php">Thông tin cá nhân</a>
                                            <a href="viewTicket.php">Lịch sử thanh toán</a>
                                            <a href="logout.php">Đăng xuất</a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="Login"> <a href="login.php">Đăng nhập</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chose_feature">
                    <div class="Location2">
                        <div class="first">
                            <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="khuyenmai.php">Khuyến mãi</a>
                            <a href="events.php">Thuê sự kiện</a>
                            <a href="giaitri.php">Giải trí</a>
                            <a href="about.php">Giới thiệu</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>  
        <div class="Page_Content">
            <div class="chiTietPhim">
                <img src="<?php echo $movie['image_movie']; ?>" id="chiTietImg" alt="">
                <div class="MoTa">
                    <h1 id="chiTietTenPhim"><?php echo $movie['movie_name']; ?></h1>
                    <div class="khoangCach">
                        <div class="phanMot"><p>Khởi chiếu:</p></div>
                        <div class="phan2" id="chiTietNgayKhoiChieu"><p><?php echo $movie['date']; ?></p></div>
                    </div>
                    <div class="khoangCach">
                        <div class="phanMot"><p>Đạo diễn:</p></div>
                        <div class="phan2" id="chiTietDaoDien"><p><?php echo $movie['daoDien']; ?></p></div>
                    </div>
                    <p id="chiTietMoTa" style="color: white; margin-top: 30px;"><?php echo $movie['describe_movie']; ?></p>
                    <div class="LienKet">
                        <a href=""><h2>TRAILER</h2></a>
                        <!-- <a href="lichChieu.php?movie_name=<?php echo $movie['movie_name']; ?>"><h2>Đặt vé</h2></a> -->
                        <a href="lichChieu.php?movie_name=<?php echo urlencode($movie['movie_name']); ?>" onclick="checkLogin(event, '<?php echo addslashes($movie['movie_name']); ?>')"><h2>Đặt vé</h2></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="end_page">
            <div class="footer">
                <div>
                    <div class="container">
                    <div class="footer-wr">
                        <div class="footer-top-mobile">&nbsp;</div>
                        <div class="footer-list row">
                            <div class="footer-item col col-4"><a href="/" class="ft-logo" aria-label="The logo of Cinestar"><img src="/assets/images/footer-logo.png" alt=""></a>
                                <div class="ft-text">
                                    <p class="txt-deskop">BE HAPPY, BE A STAR</p>
                                </div>
                                <div class="ft-group-btn"><a class="btn btn--pri" href="/movie"><span class="btn__text">mua vé</span><span class="btn__icon"><i class="icon-ic-tickets"></i></span></a>
                                    <a class="btn btn--border" href="https://cinestar.com.vn/news/detail/tuyendung"><span class="btn__text">Tuyển dụng</span><span class="btn__icon"><i class="icon-ic-career"></i></span></a>
                                </div>
                            </div>
                            <div class="footer-item col col-4">
                                <p class="footer-title">CÔNG TY CỔ PHẦN GIẢI TRÍ CINESTAR</p>
                                <ul class="footer-list-item">
                                    <li class="footer-list-item"><a href="#">Giới thiệu</a></li>
                                    <li class="footer-list-item"><a href="#">Tiện ích online</a></li>
                                    <li class="footer-list-item"><a href="#">Thẻ quà tặng</a></li>
                                    <li class="footer-list-item"><a href="#">Tuyển dụng</a></li>
                                    <li class="footer-list-item"><a href="#">Liên hệ quảng cáo</a></li>
                                   
                                    <li class="footer-list-item"><a href="#">Liên hệ công ty</a></li>
                                </ul>
                            </div>
                            <div class="footer-item col col-4">
                                <p class="footer-title">điều khoản và quy định</p>
                                <ul class="footer-list-item">
                                    <li class="footer-list-item"><a href="#">Điều khoản chung</a></li>
                                    <li class="footer-list-item"><a href="#">Điều khoản giao dịch</a></li>
                                    <li class="footer-list-item"><a href="#">Chính sách thanh toán</a></li>
                                    <li class="footer-list-item"><a href="#">Chính sách bảo mật</a></li>
                                    <li class="footer-list-item"><a href="#">Câu hỏi thường gặp</a></li>
                                    <li class="footer-list-item"><a href="#">Kết nối</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-copyright">&copy; 2022 <a href="https://cinestar.com.vn" target="_self">Cinestar.com.vn</a>. All rights reserved.</div>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>

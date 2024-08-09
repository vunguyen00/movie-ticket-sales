<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="giaitri.css">
    <title>Giải trí</title>
</head>
<body background="" style="background-color: brown;">
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">
                    <div class="viTri">
                        <a href="index.php"><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="" class="Booking_T">ĐẶT VÉ NGAY</a>
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
                                            <a href="viewTicket.php?userName= <?php echo htmlspecialchars($_SESSION['userName']) ?>">Lịch sử thanh toán</a>
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
            <div class="Content_box">
                <div style="text-align: center;text-transform: uppercase;color: white;"><h1>tất cả các loại giải trí</h1></div>
                <div class="Content_box_img">
                    <a href="giaitri_1.php"><img src="https://api-website.cinestar.com.vn/media/.renditions/wysiwyg/CMSPage/Service/service-1.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/2.html"><img src="https://api-website.cinestar.com.vn/media/.renditions/wysiwyg/CMSPage/Service/Rectangle_3463983.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/3.html"><img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/bowling-dt-2.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/4.html"><img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/billards-dt-2.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/5.html"><img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/opera-dt-2.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/6.html"><img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/gym-dt-2.png" alt=""></a>
                </div>
                <div class="Content_box_img">
                    <a href="../Giaitri/gt_con/7.html"><img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/coffee-dt-2.png" alt=""></a>
                </div>
            </div>
        </div>         
        <div class="end_page">
            <div class="footer">
                <div>
                    <div class="container">
                        <div class="footer-wr">
                            <div class="footer-list row" style="margin-left:16%;">
                                <div class="footer-item col col-4">
                                    <a href="/" class="ft-logo" aria-label="The logo of Cinestar">
                                        <img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="">
                                    </a>
                                    <div class="ft-text">
                                        <p class="txt-deskop">BE HAPPY, BE A STAR</p>
                                    </div>
                                    <div class="ft-group-btn">
                                        <a class="btn btn--pri" href="/movie">
                                            <span class="btn__text">ĐẶT VÉ</span>
                                        </a>
                                        <a class="btn btn--border" href="#">
                                            <span class="btn__text">ĐẶT BẮP NƯỚC</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">TÀI KHOẢN</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Đăng nhập</a></li>
                                        <li class="footer-list-item"><a href="#">Đăng ký</a></li>
                                        <li class="footer-list-item"><a href="#">Membership</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">XEM PHIM</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Phim đang chiếu</a></li>
                                        <li class="footer-list-item"><a href="#">Phim sắp chiếu</a></li>
                                        <li class="footer-list-item"><a href="#">Suất chiếu đặc biệt</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">THUÊ SỰ KIỆN</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Thuê rạp</a></li>
                                        <li class="footer-list-item"><a href="#">Các loại hình cho thuê khác</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">DỊCH VỤ KHÁC</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Nhà hàng</a></li>
                                        <li class="footer-list-item"><a href="#">Kidzone</a></li>
                                        <li class="footer-list-item"><a href="#">Bowling</a></li>
                                        <li class="footer-list-item"><a href="#">Billiards</a></li>
                                        <li class="footer-list-item"><a href="#">Gym</a></li>
                                        <li class="footer-list-item"><a href="#">Nhà hát Opera</a></li>
                                        <li class="footer-list-item"><a href="#">Coffee</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">HỆ THỐNG RẠP</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Cinerstar Hà Nội </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-bottom">
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                    <a href="#"><i class="fab fa-tiktok"></i></a>
                                    <a href="#"><i class="fab fa-zalo"></i></a>
                                </div>
                                <div class="footer-language">
                                    <span>Ngôn ngữ:</span>
                                    <a href="#" class="language-active"><img src="images/flag-vn.png" alt="VN"></a>
                                </div>
                            </div>
                            <div class="footer-copyright">
                                &copy; 2023 Cinestar. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

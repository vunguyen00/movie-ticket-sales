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
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng phim
$sql = "SELECT image_movie,movie_name,describe_movie FROM tblmovie";
$result = $conn->query($sql);
// Kiểm tra và lấy dữ liệu
if ($result->num_rows > 0) {
    $movies = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $movies = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="datve.css">
    <title>Đặt vé</title>    
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
                            <a href="" class="Booking_T">ĐẶT VÉ NGAY</a>
                        </div>
                        <div class="searchAndLogin">
                            <div class="searchIcon">
                                <div class="search-container">
                                    <form method="post">
                                        <input type="text" placeholder="Tìm kiếm">
                                        <button type="button" name="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85a1.007 1.007 0 0 0-.115-.098zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                        </button>
                                    </form>
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
                            <!-- Thêm biểu tượng lịch vào liên kết Lịch chiếu -->
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
        <div class="Page_Content">
            <div style="color: white; font-size: 50px; text-transform: uppercase; text-align: center; margin-top: 30px;">phim đang chiếu</div>
            <div class="container">
                <div class="slide">
                    <?php foreach ($movies as $movie): ?>
                    <div class="item" style="background-image: url('<?php echo $movie['image_movie']; ?>');">
                        <div class="content">
                            <div class="name"><?php echo $movie['movie_name']; ?></div>
                            <div class="des"><?php echo $movie['describe_movie']; ?></div>
                            <button><a style="color: black;" href="lichChieu.php?movie_name=<?php echo urlencode($movie['movie_name']); ?>" onclick="checkLogin(event, '<?php echo addslashes($movie['movie_name']); ?>')">Đặt Vé</a></button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="button">
                    <div>
                        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
                        <button style="padding-bottom: 0; width: 80px;"><a style="color: black;" href="../Datve/phimdangchieu/pdc.html">Xem thêm</a></button>
                        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                <script>
                    let next = document.querySelector('.next');
                    let prev = document.querySelector('.prev');

                    next.addEventListener('click', function() {
                        let items = document.querySelectorAll('.item');
                        document.querySelector('.slide').appendChild(items[0]);
                    });

                    prev.addEventListener('click', function() {
                        let items = document.querySelectorAll('.item');
                        document.querySelector('.slide').prepend(items[items.length - 1]);
                    });
                </script>
            </div>
        </div>
        </div>         
        <div class="end_page" style="background-color: #333333">
            <div class="footer" >
                <div>
                    <div class="container" style="background-color: #333333">
                    <div class="footer-wr" style="background-color: #333333">
                        <div class="footer-top-mobile"style="background-color: #333333">&nbsp;</div>
                        <div class="footer-list row" style="background-color: #333333">
                            <div class="footer-item col col-4"><a href="/" class="ft-logo" aria-label="The logo of Cinestar"><img src="/assets/images/footer-logo.png" alt=""></a>
                                <div class="ft-text">
                                    <p class="txt-deskop">BE HAPPY, BE A STAR</p>
                                </div>
                                <div class="ft-group-btn"><a class="btn btn--pri" href="/movie"><span class="txt">Đặt vé </span></a><a class="btn btn--outline" href="/popcorn-drink"><span class="txt">Đặt bắp nước</span></a></div>
                
                                <div class="ft-menu-mobile">
                                    <ul class="menu-list">
                                        <li class="menu-item"><a href="" class="menu-link"> Tài khoản</a></li>
                                        <li class="menu-item"><a href="" class="menu-link">Cho thuê sự kiện</a></li>
                                        <li class="menu-item"><a href="" class="menu-link">Dịch vụ khác</a></li>
                                        <li class="menu-item"><a href="" class="menu-link">Giới thiệu</a></li>
                                        <li class="menu-item"><a class="menu-link" href="">Chính sách bảo mật</a></li>
                                        <li class="menu-item"><a href="" class="menu-link">Tin tức</a></li>
                                        <li class="menu-item"><a href="" class="menu-link">Tuyển dụng</a></li>
                                        <li class   ="menu-item"><a href="" class="menu-link">Liên hệ</a></li>
                                    </ul>
                                </div>
                                <div class="ft-hotline-socials">
                                    <ul class="list">
                                        <li class="item item-fb"><a href=" class="link" aria-label="Facebook of Cinestart">
                                                <img src="/assets/images/footer-facebook.svg" alt=""></a></li>
                                        <!-- <li class="item item-ig"><a href="https://www.instagram.com/cine_star/" class="link"> <img
                                                    src="/assets/images/footer-instagram.svg" alt=""></a></li>
                                        <li class="item item-lk">
                                            <a class="link"> <img src="/assets/images/footer-linkedIn.svg" alt=""></a></li> -->
                                        <li class="item item-yt">
                                            <a class="link" href="" aria-label="Youtube of Cinestar">
                                                <img src="" alt=""></a></li>
                                        <li class="item item-tt">
                                            <a class="link" href="" aria-label="Tiktok of Cinestar">
                                                <img src="" alt=""></a></li>
                <li class="item item-zl">
                                            <a class="link" href=" ria-label="Zalo of Cinestar">
                                                <img src="" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="ft-lg">
                                    <div class="txt">
                                        <p>Ngôn ngữ:</p>
                                    </div>
                                    <div class="lg-action popUpJs" id="lang-footer" data-popup="dt-lg-footer">
                                        <div class="lg-popup" data-ui-id="lang-vn">
                                            <div class="lg-option">
                                                <span class="image">
                                                    <img src="" alt="">
                                                </span>
                                                <span class="txt">VN</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        
                <div class="footer-item col col-4">
                                <div class="row footer-item-top"><div class="col-6 col">
                                    <div class="text">Tài khoản</div>
                                    <ul class="menu-list">
                                        <li class="menu-item"><a class="menu-link" href="">Đăng nhập</a></li>
                                        <li class="menu-item"><a class="menu-link" href="">Đăng ký</a></li>
                                        <li class="menu-item"><a class="menu-link" href="">Membership</a></li>
                                    </ul>
                                </div><div class="col-6 col">
                                
                                <div class="text">Thuê sự kiện</div>
                                <ul class="menu-list">
                                    <li class="menu-item"><a class="menu-link" href="">Thuê rạp</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Các loại hình cho thuê khác</a>
                                </li></ul>
                                </div></div>
                                <div class="row footer-item-bot"><div class="col-6 col">
                                    <div class="text">Xem Phim</div>
                                    <ul class="menu-list">
                                        <li class="menu-item"><a class="menu-link" href="">Phim đang chiếu</a></li>
                                        <li class="menu-item"><a class="menu-link" href="">Phim sắp chiếu</a></li>
                                    </ul>
                                </div><div class="col-6 col">
                                    <div class="text">Cinestar</div>
                                    <ul class="menu-list">
                                        <li class="menu-item"><a class="menu-link" href="/about-us">Giới thiệu</a></li>
                                        <li class="menu-item"><a class="menu-link" href="/contact">Liên hệ</a></li>
                                        <li class="menu-item"><a class="menu-link" href="/career/">Tuyển dụng</a></li>
                                    </ul>
                                </div></div>
                            </div>
                            <div class="footer-item col col-2">
                                <div class="text">Dịch vụ khác</div>
                                <ul class="menu-list">
                                    <li class="menu-item"><a class="menu-link" href="">Nhà hàng</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Kidzone</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Bowling</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Billiards</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Gym</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Nhà hát Opera</a></li>
                                    <li class="menu-item"><a class="menu-link" href="">Coffee</a></li>
                                </ul>
                            </div>
                            <div class="footer-item col col-2">
                                <div class="text">Hệ thống rạp</div>
                                <ul class="menu-list">
                                    
                <li class="menu-item"><a class="menu-link" href="">Tất cả hệ thống rạp</a></li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/8f3a5832-8340-4a43-89bc-6653817162f1"> Cinestar Quốc Thanh </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/667c7727-857e-4aac-8aeb-771a8f86cd14"> Cinestar Hai Bà Trưng (TP.HCM) </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/cf13e1ce-2c1f-4c73-8ce5-7ef65472db3c"> Cinestar Sinh Viên (Bình Dương) </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/8f54df74-3796-42ea-896e-cd638eec1fe3"> Cinestar Mỹ Tho </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/4a51b9ee-f143-4411-9dbb-5f54a1c382c0"> Cinestar Kiên Giang </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/104509be-034e-47c1-bf1b-aba7f2df4f28"> Cinestar Lâm Đồng </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/e08f986a-1937-419e-b1b1-759b7c74728b"> Cinestar Đà Lạt </a> </li> <li class="menu-item"> <a class="menu-link" href="/book-tickets/f8a60463-5c34-49a9-9ae8-52081e387bb8"> Cinestar Huế </a> </li>
                
                                </ul>
                            </div>
                        </div>
                        <div class="footer-bottom">
                            <div class="footer-bottom-left">© 2023 Cinestar. All rights reserved.</div>
                            <ul class="menu-list" style="list-style-type:none;">
                                <li class="menu-item"><a class="menu-link" href="">Chính sách bảo mật</a></li>
                                <li class="menu-item"><a class="menu-link" href="">Tin điện ảnh</a></li>
                                <li class="menu-item"><a class="menu-link" href="">Hỏi và đáp</a></li>
                                <!-- <li class="menu-item"><a class="menu-link" href="/career/">Tuyển dụng</a></li>
                                <li class="menu-item"><a class="menu-link" href="/contact">Liên hệ</a></li>
                                <li class="menu-item"><a class="menu-link" href="/about-us">Giới thiệu</a></li> -->
                            </ul>
                        </div>
                    </div>
            </div>
            <div classname="ft-author">
                    <div classname="container" style="
                /* justify-content: center; */
                text-align: center;
            ">
                      <div classname="ft-bct" style="
                width: 143px;
                /* height: 50px; */
                margin: 12px auto;
            "><a href="" target="_blank" aria-label="Ministry of Industry and Trade recognized Cinestar">
                         <img src="" alt=""> </a>
                      </div>
                      <div classname="ft-author-content" style="font-size: 10px">
                        <ul style="list-style-type:none;">
                          <li>
                            CÔNG TY CỔ PHẦN GIẢI TRÍ PHÁT HÀNH PHIM – RẠP CHIẾU PHIM NGÔI SAO
                            <br>
                            ĐỊA CHỈ: 135 HAI BÀ TRƯNG, PHƯỜNG BẾN NGHÉ, QUẬN 1, TP.HCM
                          </li>
                          <li>
                            GIẤY CNĐKDN SỐ: 0312742744, ĐĂNG KÝ LẦN ĐẦU NGÀY 18/04/2014, ĐĂNG KÝ THAY ĐỔI LẦN THỨ 2 NGÀY 15/09/2014, CẤP BỞI SỞ KH&amp;ĐT TP.HCM
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
            <script>
            console.log("run script admin");
            </script>
            <script src=""></script></div></div>
        </div>
    </div>
</body>
</html>

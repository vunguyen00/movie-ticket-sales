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
    <link rel="stylesheet" href="giaitri_1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Đăng nhập</title>
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
                            <a href="" class="Booking_F">ĐẶT BẮP NƯỚC</a>
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
                        <nav class="first">
                            <!-- Thêm biểu tượng địa điểm vào nút Chọn rạp -->
                            <button><i class="fas fa-map-marker-alt"></i> Chọn rạp</button>
                            <ul class="menu1">
                                <li><a href="">Cinerstar Hồ Chí Minh</a></li>
                                <li><a href="">Cinerstar Hà Nội</a></li>
                                <li><a href="">Cinerstar Đà Nẵng</a></li>
                            </ul>
                        </nav>
                        
                        <div class="second">
                            <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="">Khuyến mãi</a>
                            <a href="events.php">Thuê sự kiện</a>
                            <a href="giaitri.php">Giải trí</a>
                            <a href="viewTicket.php">Dịch Vụ Đặc Biệt</a> 
                            <a href="gioithieu.php">Giới thiệu</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>  
        <div class="Page_Content">
            <div>
                <img src="https://api-website.cinestar.com.vn/media/wysiwyg/CMSPage/Service/bg-kidzone_1_.jpg" alt="">
            </div>
            <div class="text_center">
                <h1>KIDZONE</h1>
                <p>Giải phóng trí tưởng tượng của con bạn tại Kidzone, sân chơi trong nhà tuyệt đỉnh. 
                    Hãy để các bé khám phá một thế giới vui nhộn và khám phá tại Kidzone, khu vui chơi trong nhà rộng rãi được thiết kế dành cho trẻ em ở mọi lứa tuổi.
                    C’Kidzone cung cấp hơn 25 trò chơi đa dạng và hấp dẫn, bao gồm các hồ banh kết hợp chướng ngại vật đầy thử thách và mảng tường leo núi thú vị. Tất cả các thiết bị đều được chọn lọc kỹ và cẩn thận để đảm bảo môi trường vui chơi an toàn cho các bé.
                    C’Kidzone không chỉ là một không gian vui chơi giải trí, chúng tôi còn cung cấp một không gian sôi động, nơi các bé có thể kết bạn mới, phát triển các kỹ năng thể chất và khơi dậy khả năng sáng tạo. C’Kidzone có thêm dịch vụ trọn gói nhận tổ chức tiệc, sự kiện cho các bé
                    Hãy để bé yêu của bạn tận hưởng những trải nghiệm tuyệt vời tại đây!</p>
            </div>
            <div class="bottom_all">
                <div class="bottom_all_text">
                    <div class="bat">
                        <h2>CINESTAR HUẾ</h2>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined">where_to_vote</span>
                            <a style="padding-left: 10px;" href="https://www.google.com/maps/place/Cinestar+Hu%E1%BA%BF/@16.4609622,107.5897538,17z/data=!3m1!4b1!4m6!3m5!1s0x3141a1ed3c48b8e9:0xfafa16e6a736e872!8m2!3d16.4609622!4d107.5897538!16s%2Fg%2F11h10w6mv5?entry=ttu">25 Hai Bà Trưng, Vĩnh Ninh, Thành phố Huế  </a>
                        </div>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined"> home </span>
                            <a style="padding-left: 10px;" href="https://www.facebook.com/CinestarHue">https://www.facebook.com/CinestarHue</a>
                        </div>
                    </div>

                    <div class="bat">
                        <h2>CINESTAR MỸ THO</h2>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined">where_to_vote</span>
                            <a style="padding-left: 10px;" href="https://www.google.com/maps/place/Cinestar+M%E1%BB%B9+Tho/@10.3556662,106.3688009,17z/data=!3m1!4b1!4m6!3m5!1s0x310aafcf3e3e46d7:0x9c8785d5b0bd58b5!8m2!3d10.3556609!4d106.3713758!16s%2Fg%2F11g2z95n8z?entry=tts"> 52 Đinh Bộ Lĩnh, Phường 3, Thành phố Mỹ Tho</a>
                        </div>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined"> home </span>
                            <a style="padding-left: 10px;" href="https://www.facebook.com/CinestarMyTho">https://www.facebook.com/CinestarMyTho</a>
                        </div>
                    </div>
                </div>
                <div class="bottom_all_text">
                    <div class="bat">
                        <h2>CINESTAR ĐÀ LẠT</h2>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined">where_to_vote</span>
                            <a style="padding-left: 10px;" href="https://www.google.com/maps/place/Cinestar+%C4%90%C3%A0+L%E1%BA%A1t/@11.9383958,108.4431709,17z/data=!3m1!4b1!4m6!3m5!1s0x3171136387a15c0f:0x60ad2d72ff0a9d2a!8m2!3d11.9383906!4d108.4457458!16s%2Fg%2F11s8xxpk92?entry=tts">Quảng trường Lâm Viên, Thành phố Đà Lạt </a>
                        </div>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined"> home </span>
                            <a style="padding-left: 10px;" href="https://www.facebook.com/CinestarDaLat">https://www.facebook.com/CinestarDaLat</a>
                        </div>
                    </div>
                    
                    <div class="bat">
                        <h2>CINESTAR KIÊN GIANG</h2>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined">where_to_vote</span>
                            <a style="padding-left: 10px;" href="https://www.google.com/maps/place/Cinestar+Ki%C3%AAn+Giang/@9.9531899,105.118427,17z/data=!3m1!4b1!4m6!3m5!1s0x31a0b5637be8a609:0x4ae933c66835d7fa!8m2!3d9.9531846!4d105.1210019!16s%2Fg%2F11s589xh__?entry=tts">Trung tâm Thương mại, Rạch Sỏi, Tp. Rạch Giá </a>
                        </div>
                        <div style="display: flex;">
                            <span class="material-symbols-outlined"> home </span>
                            <a style="padding-left: 10px;" href="https://www.facebook.com/CinestarKienGiang">https://www.facebook.com/CinestarKienGiang</a>
                        </div>
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

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
    <link rel="stylesheet" href="index_page.css">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body>
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">  
                    <div class="viTri">
                        <a href=""><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>                        </div>
                        <div class="searchAndLogin">
                            <div class="searchIcon">
                                <!-- <div class="search-container">
                                    <input type="text" placeholder="Tìm kiếm">
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85a1.007 1.007 0 0 0-.115-.098zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div> -->
                                <div class="search-container">
                                    <form action="searchMovies.php" method="GET">
                                        <input type="text" name="query" placeholder="Tìm kiếm">
                                        <button type="submit">
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
                        <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="khuyenmai.php">Khuyến mãi</a>
                            <a href="events.php">Thuê sự kiện</a>
                            <a href="giaitri.php">Giải trí</a>
                            <a href="about.php">Giới thiệu</a>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>  
        <div class="Page_Content">
            <!-- this is page content -->
            <div class="slider-container">
                <div class="slider">
                    <div class="slides">
                        <img src="images/20_-coke.webp" alt="">
                        <img src="images/1215x365_1_.webp" alt="">
                        <img src="images/1215x365_4_.webp" alt="">
                        <img src="images/1215x560.webp" alt="">
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.slides').slick({
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        dots: true,
                        arrows: true,
                    });
                });
            </script>
            <div class="container1">
                <h1 style="margin-bottom:40px;">PHIM ĐANG CHIẾU</h1>
                <div class="playing_movies" id="playing_movies">
                </div>
                <!-- <h3 class="name">${movie.movie_name}</h3>  movie-->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            fetch('getPlayingMovies.php')
                                .then(response => response.json())
                                .then(data => {
                                    const playingMoviesDiv = document.getElementById('playing_movies');
                                    data.forEach(movie => {
                                        const movieDiv = document.createElement('div');
                                        movieDiv.classList.add('playing_movie');
                                        movieDiv.innerHTML = `
                                       <div class="movie">
                                            <img src="${movie.image_movie}" alt="${movie.movie_name}">
    
                                            <div class="movie_information">
                                                <h2>${movie.movie_name}</h2>
                                                <p>${movie.thoiLuong}</p>
                                                <p>${movie.daoDien}</p>
                                                <a href="details.php?movie_name=${movie.movie_name}" style="margin-left:0%; border:solid 1px none; border-radius:40%; background-color:yellow; padding: 5px; color:black;">Chi tiết</a>
                                            </div>
                                        </div>
                                        `;
                                        playingMoviesDiv.appendChild(movieDiv);
                                    });
                                    $('.playing_movies').slick({
                                    slidesToShow: 4,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    arrows: true,
                                    draggable: false,
                                    autoplay: true,
                                    autoplaySpeed: 1500,
                                    prevArrow: `<button type='button' class='slick-prev slick-arrow'></button>`,
                                    nextArrow: `<button type='button' class='slick-next slick-arrow'></button>`,
                                    responsive: [
                                        {
                                            breakpoint: 1024,
                                            settings: {
                                                slidesToShow: 3,
                                            }
                                        },
                                        {
                                            breakpoint: 480,
                                            settings: {
                                                slidesToShow: 1,
                                                arrows: false,
                                                infinite: false
                                            }
                                        }
                                    ]
                                });
                            })
                            .catch(error => console.error('Error fetching movies:', error));
                        });
                                    
                    </script>

                    <div style=" margin-top: 20px;margin-bottom:60px;">
                    <a href="playingMovies.php" style="color: white;">XEM THÊM</a>    
                    </div>
                
                <h1 style="margin-bottom:40px;">PHIM SẮP CHIẾU</h1>
                <div class="comming_movies" id="comming_movies">
                
                </div>
                <!-- <h3 class="name">${movie.movie_name}</h3>   movie-->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            fetch('getComingMovies.php')
                                .then(response => response.json())
                                .then(data => {
                                    const playingMoviesDiv = document.getElementById('comming_movies');
                                    data.forEach(movie => {
                                        const movieDiv = document.createElement('div');
                                        movieDiv.classList.add('comming_movie');
                                        movieDiv.innerHTML = `
                                        <div class="movie">
                                            <img src="${movie.image_movie}" alt="${movie.movie_name}">
                                            
                                            <div class="movie_information">
                                                <h2>${movie.movie_name}</h2>
                                                <p>${movie.thoiLuong}</p>
                                                <p>${movie.daoDien}</p>
                                                <a href="details.php?movie_name=${movie.movie_name}"style="margin-left:0%; border:solid 1px none; border-radius:40%; background-color:yellow; padding: 5px; color:black;">Chi tiet</a>
                                            </div>
                                        </div>
                                        `;
                                        playingMoviesDiv.appendChild(movieDiv);
                                    });
                                    $('.comming_movies').slick({
                                    slidesToShow: 4,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    arrows: true,
                                    draggable: false,
                                    autoplay: true,
                                    autoplaySpeed: 1500,
                                    prevArrow: `<button type='button' class='slick-prev slick-arrow'></button>`,
                                    nextArrow: `<button type='button' class='slick-next slick-arrow'></button>`,
                                    responsive: [
                                        {
                                            breakpoint: 1024,
                                            settings: {
                                                slidesToShow: 3,
                                            }
                                        },
                                        {
                                            breakpoint: 480,
                                            settings: {
                                                slidesToShow: 1,
                                                arrows: false,
                                                infinite: false
                                            }
                                        }
                                    ]
                                });
                            })
                            .catch(error => console.error('Error fetching movies:', error));
                        });
                                    
                    </script>
                
                    <div style=" margin-top: 20px;margin-bottom:40px;">
                        <a href="comingMovie.php" style="">XEM THÊM</a>   
                    </div>
                <script
                        type="text/javascript"
                        src="https://code.jquery.com/jquery-1.11.0.min.js"
                        ></script>
                        
                        <script
                        type="text/javascript"
                        src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
                        ></script>
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

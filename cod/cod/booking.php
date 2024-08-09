<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['userName']);
}

include "connectToDatabase.php";

$movie_name = $_GET['movie_name'];
$thoiGian = $_GET['thoiGian'];
$date = $_GET['date'];
$screen_id = $_GET['screen_id'];

$sql = "SELECT price FROM tblmovie WHERE movie_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $movie_name);
$stmt->execute();
$stmt->bind_result($moviePrice);
$stmt->fetch();
$stmt->close();

$sql = "SELECT seat_name, status FROM tblseat WHERE screen_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $screen_id);
$stmt->execute();
$result = $stmt->get_result();

$seats = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="booking.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body>
    <div class="menu">
        <div class="chung">
            <div class="function">  
                <div class="viTri">
                    <a href=""><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                    <div class="bookAndpd">
                        <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>
                    </div>
                    <div class="searchAndLogin">
                        <div class="searchIcon">
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
                    <div class="first">
                        <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                        <a href="khuyenmai.php">Khuyến mãi</a>
                        <a href="events.php">Thuê sự kiện</a>
                        <a href="about.php">Giới thiệu</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <h1>Tên phim: <?php echo htmlspecialchars($movie_name); ?></h1>
    <h1>Ngày chiếu: <?php echo htmlspecialchars($date); ?></h1>
    <h1>Giờ chiếu: <?php echo htmlspecialchars($thoiGian); ?></h1>
    <h1>Phòng chiếu: <?php echo htmlspecialchars($screen_id); ?></h1>
    <h1>Vui lòng lựa chọn thông tin</h1>
    <div class="book-tickets">
        <div class="ticket-selection">
            <label for="num-tickets">Số lượng vé:</label>
            <div class="ticket-selector">
            <button type="button" onclick="decreaseTickets()">-</button>
            <input type="text" id="num-tickets" value="1" readonly>
            <button type="button" onclick="increaseTickets()">+</button>
            </div>
            <script>
        function decreaseTickets() {
            var input = document.getElementById('num-tickets');
            var value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        function increaseTickets() {
            var input = document.getElementById('num-tickets');
            var value = parseInt(input.value);
            if (value < 10) {
                input.value = value + 1;
            }
        }
    </script>
    </div>
        </div>
        <div class="seat-selection">
            <div class="section-title">CHỌN GHẾ</div>
            <div class="seat-screen"><h1>Màn Hình</h1></div>
            <div class="seat-grid" id="seatGrid">
                <?php foreach ($seats as $seat): ?>
                <div class="seat <?= $seat['status'] == 'available' ? '' : 'unavailable'; ?>">
                    <?= htmlspecialchars($seat['seat_name']); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="food-selection">
            <div class="section-title">CHỌN BẮP NƯỚC</div>
            <div class="food-item">
                <img src="./images/Combo-Solo.png" alt="Combo Solo">
                <div>COMBO SOLO</div>
                <div>1 Bắp + 1 Coca</div>
                <div>84,000 VNĐ</div>
                <button class="minus">-</button><span>0</span><button class="plus">+</button>
            </div>
            <div class="food-item">
                <img src="./images/Combo-Couple.png" alt="Combo Couple">
                <div>COMBO COUPLE</div>
                <div>Combo 1 Bắp + 2 Coca</div>
                <div>105,000 VNĐ</div>
                <button class="minus">-</button><span>0</span><button class="plus">+</button>
            </div>
            <div class="food-item">
                <img src="./images/Combo-Party.png" alt="Combo Party">
                <div>COMBO PARTY</div>
                <div>Combo 3 Bắp + 3 Coca</div>
                <div>199,000 VNĐ</div>
                <button class="minus">-</button><span>0</span><button class="plus">+</button>
            </div>
        </div>

        <div class="total-price">
            Tổng: <span>0</span>
        </div>
        <div class="btn">
            <button class="btn-back" onclick="window.history.back()">Quay lại</button>
            <button class="btn-book">Đặt Vé</button>
        </div>
    </div>

    <script>
        const seatGrid = document.getElementById('seatGrid');
        const numTicketsSelect = document.getElementById('num-tickets');
        const totalPriceElem = document.querySelector('.total-price span');
        const btnBook = document.querySelector('.btn-book');
        const foodItems = document.querySelectorAll('.food-item');

        let selectedSeats = [];
        let selectedFood = {'COMBO SOLO': 0, 'COMBO COUPLE': 0, 'COMBO PARTY': 0};

        seatGrid.addEventListener('click', function(e) {
            const seat = e.target.closest('.seat');
            if (!seat || seat.classList.contains('unavailable')) return;

            const seatName = seat.textContent.trim();
            const ticketCount = parseInt(numTicketsSelect.value, 10);

            if (selectedSeats.includes(seatName)) {
                seat.classList.remove('selected');
                selectedSeats = selectedSeats.filter(s => s !== seatName);
            } else {
                if (selectedSeats.length < ticketCount) {
                    seat.classList.add('selected');
                    selectedSeats.push(seatName);
                }
            }

            updateTotalPrice();
        });

        numTicketsSelect.addEventListener('change', updateTotalPrice);

        foodItems.forEach(foodItem => {
            const minusButton = foodItem.querySelector('.minus');
            const plusButton = foodItem.querySelector('.plus');
            const quantityElem = foodItem.querySelector('span');

            minusButton.addEventListener('click', function() {
                const quantity = parseInt(quantityElem.textContent, 10);
                if (quantity > 0) {
                    quantityElem.textContent = quantity - 1;
                    selectedFood[foodItem.querySelector('div').textContent] -= 1;
                    updateTotalPrice();
                }
            });

            plusButton.addEventListener('click', function() {
                const quantity = parseInt(quantityElem.textContent, 10);
                quantityElem.textContent = quantity + 1;
                selectedFood[foodItem.querySelector('div').textContent] += 1;
                updateTotalPrice();
            });
        });

        btnBook.addEventListener('click', function() {
            const ticketCount = parseInt(numTicketsSelect.value, 10);

            if (selectedSeats.length !== ticketCount) {
                alert('Vui lòng chọn đủ số lượng ghế.');
                return;
            }

            const bookingData = {
                movie_name: <?= json_encode($movie_name) ?>,
                date: <?= json_encode($date) ?>,
                time: <?= json_encode($thoiGian) ?>,
                screen_id: <?= json_encode($screen_id) ?>,
                seats: selectedSeats,
                food: selectedFood,
                total_price: totalPriceElem.textContent
            };

            fetch('bill.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(bookingData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Đặt vé thất bại: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi khi đặt vé:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
            });
        });



        function updateTotalPrice() {
            const ticketPrice = <?= json_encode($moviePrice) ?>;
            const ticketCount = parseInt(numTicketsSelect.value, 10);
            const seatTotal = ticketCount * ticketPrice;

            const foodPrices = {
                'COMBO SOLO': 84000,
                'COMBO COUPLE': 105000,
                'COMBO PARTY': 199000
            };

            const foodTotal = Object.keys(selectedFood).reduce((total, food) => {
                return total + selectedFood[food] * foodPrices[food];
            }, 0);

            const total = seatTotal + foodTotal;
            totalPriceElem.textContent = total.toLocaleString() + ' VNĐ';
        }
    </script>
</body>
</html>

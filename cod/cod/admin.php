<?php
include "takeShowTimeIn4.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDisplay.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <div class="navigation">
        <a href="logout.php">Đăng xuất</a>
        <a href="index.php">Trang chủ</a>
        <a href="printFile.php">Doanh thu</a>
    </div>
    <input type="text" id="code_bill" placeholder="Nhập mã" style="width: 200px; margin-left:20px;">
    <button type="submit" id="code">Tìm hóa đơn</button>
    <div class="khungChinh">
        <h2>Quản lý phim</h2>
        <div class="cacThuocTinhPhim" id="movieForm">
            <div>ID: <input type="text" id="idPhim"></div>
            <div>Tên phim: <input type="text" id="tenPhim"></div>
            <div>Ảnh: <input type="text" id="fileImage"></div>
            <div>Mô tả: <textarea id="Mota" name="message" rows="4" cols="50"></textarea></div>
            <div>Thời lượng: <input type="number" id="thoiLuong"></div>
            <div>Đạo diễn và diễn viên: <input type="text" name="daoDien" id="daoDien"></div>
            <div>Ngày chiếu: <input type="date" id="ngayChieu"></div>
            <div>Phòng chiếu: 
                <select name="number" id="phongChieu">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
            <div>Trạng thái phim: 
                <select name="status" id="status">
                    <option value="playing">playing</option>
                    <option value="comming">comming</option>
                </select>
            </div>
            <div>Giá vé: <input type="number" id="price"></div>
        </div>
        <div class="PhimChucNang">
            <button id="add-button">Add</button>
            <button id="delete-button">Delete</button>
            <button id="edit-button">Edit</button>
        </div>
    </div>
    <div class="khungChinh">
        <h2>Thời gian và phòng chiếu</h2>
        <div>Ma chiếu: <input type="number" id="showtime_id"></div>
        <div>Thời gian: <input type="time" id="thoiGian"></div>
        <div>Ngày chiếu: <input type="date" id="date_time"></div>
        <div>Ma phim: <input type="text" id="idPhim2"></div>
        <div class="PhimChucNang">
            <button id="add-button2">Add</button>
            <button id="delete-button2">Delete</button>
            <button id="edit-button2">Edit</button>
        </div>
    </div>
    <div>
        <h2>Lịch Chiếu</h2>
        <table>
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Tên Phim</th>
                    <th>Ảnh</th>
                    <th>Giờ Chiếu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $movies = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $idPhim = htmlspecialchars($row['showtime_id']);
                        if (!isset($movies[$idPhim])) {
                            $movies[$idPhim] = [
                                'movie_name' => htmlspecialchars($row['movie_name']),
                                'image_movie' => htmlspecialchars($row['image_movie']),
                                'showtimes' => []
                            ];
                        }
                        $movies[$idPhim]['showtimes'][] = htmlspecialchars($row['thoiGian']) . ' ' . htmlspecialchars($row['date']);
                    }
                }

                if (!empty($movies)) {
                    foreach ($movies as $idPhim => $movie) {
                        echo "<tr>";
                        echo "<td>{$idPhim}</td>";
                        echo "<td>{$movie['movie_name']}</td>";
                        echo "<td><img src='{$movie['image_movie']}' alt='{$movie['movie_name']}' onerror=\"this.onerror=null;this.src='default.jpg';\"></td>";
                        echo "<td>" . implode('<br>', $movie['showtimes']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có lịch chiếu nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <div>
            <div class="cacPhimDangChieu"></div>
            <div class="cacPhimSapChieu"></div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-button2').addEventListener('click', function() {
                const idPhim2 = document.getElementById('idPhim2').value;
                const thoiGian = document.getElementById('thoiGian').value;
                const date_time = document.getElementById('date_time').value;
                const status = document.getElementById('status').value;
                const showtime_id = document.getElementById('showtime_id').value;

                const formData = new FormData();
                formData.append('idPhim2', idPhim2);
                formData.append('thoiGian', thoiGian);
                formData.append('date_time', date_time);
                formData.append('status', status);
                formData.append('showtime_id', showtime_id);

                fetch('addShowtime.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
            document.getElementById('code').addEventListener('click', function(){
            const code = document.getElementById('code_bill').value;
            const formData = new FormData();
            formData.append('code_bill', code);

            fetch('find_codeBill.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); 
                } else {
                    const billDetails = `
                        Hóa đơn tìm thấy:
                        Người đặt: ${data.user}
                        Tên phim: ${data.movie_name}
                        Ghế: ${data.seat}
                        Tổng giá: ${data.total}
                    `;
                    alert(billDetails);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

            document.getElementById('delete-button2').addEventListener('click', function() {
                const showtime_id = document.getElementById('showtime_id').value;

                if (!showtime_id) {
                    alert('Please enter a showtime ID to delete.');
                    return;
                }

                const formData = new FormData();
                formData.append('showtime_id', showtime_id);

                fetch('deleteShowtime.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            document.getElementById('edit-button2').addEventListener('click', function() {
                const idPhim2 = document.getElementById('idPhim2').value;
                const thoiGian = document.getElementById('thoiGian').value;
                const date_time = document.getElementById('date_time').value;
                const showtime_id = document.getElementById('showtime_id').value;

                if (!showtime_id) {
                    alert('Please enter a showtime ID to edit.');
                    return;
                }

                const formData = new FormData();
                formData.append('idPhim2', idPhim2);
                formData.append('thoiGian', thoiGian);
                formData.append('date_time', date_time);
                formData.append('showtime_id', showtime_id);

                fetch('editShowtime.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            document.getElementById('add-button').addEventListener('click', function() {
                const idPhim = document.getElementById('idPhim').value;
                const tenPhim = document.getElementById('tenPhim').value;
                const fileImage = document.getElementById('fileImage').value;
                const Mota = document.getElementById('Mota').value;
                const thoiLuong = document.getElementById('thoiLuong').value;
                const daoDien = document.getElementById('daoDien').value;
                const ngayChieu = document.getElementById('ngayChieu').value;
                const phongChieu = document.getElementById('phongChieu').value;
                const status = document.getElementById('status').value;
                const price = document.getElementById('price').value;

                const formData = new FormData();
                formData.append('idPhim', idPhim);
                formData.append('tenPhim', tenPhim);
                formData.append('fileImage', fileImage);
                formData.append('Mota', Mota);
                formData.append('thoiLuong', thoiLuong);
                formData.append('daoDien', daoDien);
                formData.append('ngayChieu', ngayChieu);
                formData.append('phongChieu', phongChieu);
                formData.append('status', status);
                formData.append('price', price);

                fetch('addMovie.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            document.getElementById('delete-button').addEventListener('click', function() {
                const tenPhim = document.getElementById('idPhim').value;

                if (!tenPhim) {
                    alert('Please enter a movie name to delete.');
                    return;
                }

                const formData = new FormData();
                formData.append('idPhim', tenPhim);

                fetch('deleteMovie.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            document.getElementById('edit-button').addEventListener('click', function() {
                const idPhim = document.getElementById('idPhim').value;
                const tenPhim = document.getElementById('tenPhim').value;
                const fileImage = document.getElementById('fileImage').value; 
                const Mota = document.getElementById('Mota').value;
                const thoiLuong = document.getElementById('thoiLuong').value;
                const daoDien = document.getElementById('daoDien').value;
                const ngayChieu = document.getElementById('ngayChieu').value;
                const phongChieu = document.getElementById('phongChieu').value;
                const status = document.getElementById('status').value;
                const price = document.getElementById('price').value;

                if (!idPhim) {
                    alert('Please enter id movie to edit.');
                    return;
                }

                const formData = new FormData();
                formData.append('idPhim', idPhim);
                formData.append('tenPhim', tenPhim);
                formData.append('fileImage', fileImage);
                formData.append('Mota', Mota);
                formData.append('thoiLuong', thoiLuong);
                formData.append('daoDien', daoDien);
                formData.append('ngayChieu', ngayChieu);
                formData.append('phongChieu', phongChieu);
                formData.append('status', status);
                formData.append('price', price);

                fetch('editMovie.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            function fetchMovies(status, containerClass) {
                fetch(status === 'playing' ? 'getPlayingMovies.php' : 'getComingMovies.php')
                .then(response => response.json())
                .then(movies => {
                    const container = document.querySelector(containerClass);
                    container.innerHTML = ''; 
                    movies.forEach(movie => {
                        const movieDiv = document.createElement('div');
                        movieDiv.classList.add('movie');
                        movieDiv.innerHTML = `
                            <p>${movie.movie_id}</p>
                            <h3>${movie.movie_name}</h3>
                            <img src="${movie.image_movie}" alt="${movie.movie_name}" onerror="this.onerror=null;this.src='default.jpg';">
                            <p>${movie.describe_movie}</p>
                            <p>Thời lượng: ${movie.thoiLuong}</p>
                            <p>Đạo diễn: ${movie.daoDien}</p>
                            <p>Ngày chiếu: ${movie.date}</p>
                            <p>Phòng chiếu: ${movie.screen_id}</p>
                            <p>Số vé đã bán: ${movie.number_tickets_sold}</p>
                            <p>Trạng thái: ${movie.status_movie}</p>
                            <p>Giá vé: ${movie.price}</p>
                            <button class="displayInformation">Sửa</button>
                        `;
                        movieDiv.querySelector('.displayInformation').addEventListener('click', function() {
                            document.getElementById('idPhim').value = movie.movie_id;
                            document.getElementById('tenPhim').value = movie.movie_name;
                            document.getElementById('fileImage').value = movie.image_movie;
                            document.getElementById('Mota').value = movie.describe_movie;
                            document.getElementById('thoiLuong').value = movie.thoiLuong;
                            document.getElementById('daoDien').value = movie.daoDien;
                            document.getElementById('ngayChieu').value = movie.date;
                            document.getElementById('phongChieu').value = movie.screen_id;
                            document.getElementById('status').value = movie.status_movie;
                            document.getElementById('price').value = movie.price;
                            
                            document.getElementById('movieForm').scrollIntoView({ behavior: 'smooth' });
                        });
                        container.appendChild(movieDiv);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            fetchMovies('playing', '.cacPhimDangChieu');
            fetchMovies('coming', '.cacPhimSapChieu');
        });
    </script>
</body>
</html>
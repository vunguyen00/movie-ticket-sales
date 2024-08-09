<?php
session_start();
if (!isset($_SESSION['userName'])) {
    header("Location: login.php");
    exit();
}

// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dacs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$userName = $_SESSION['userName'];
$sql = $conn->prepare("SELECT * FROM tblticket WHERE userName = ?");
$sql->bind_param("s", $userName);
$sql->execute();
$result = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vé đã đặt</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            background-color: white;
            color: white;
        }
    </style>
</head>
<body>
    <div class="main_body">
        <h1>Tất cả vé đã đặt</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tên phim</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Ghế</th>
                <th>Thức ăn</th>
                <th>Tổng giá</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['movie']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DATE']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TIME']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['seat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['food']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có vé nào.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <a href="index.php">Quay lại trang chủ</a>
    </div>
</body>
</html>

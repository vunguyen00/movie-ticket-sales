<?php
session_start();
$data = $_SESSION['booking_details'] ?? null;

if ($data === null) {
    die('Dữ liệu không hợp lệ');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <link rel="stylesheet" href="bill.css">
</head>
<body>
    <h1>Hóa Đơn</h1>
    <p>Tên phim: <?= htmlspecialchars($data['movie_name']) ?></p>
    <p>Ngày chiếu: <?= htmlspecialchars($data['date']) ?></p>
    <p>Giờ chiếu: <?= htmlspecialchars($data['time']) ?></p>
    <p>Phòng chiếu: <?= htmlspecialchars($data['screen_id']) ?></p>
    <p>Số lượng vé: <?= htmlspecialchars(count($data['seats'])) ?></p>
    <p>Danh sách ghế đã chọn:</p>
    <ul>
        <?php foreach ($data['seats'] as $seat): ?>
            <?= htmlspecialchars($seat) ?>,
        <?php endforeach; ?>
    </ul>
    <p>Dịch vụ kèm theo:</p>
    <ul>
        <?php foreach ($data['food'] as $food => $quantity): ?>
            <?php if ($quantity > 0): ?>
                <li><?= htmlspecialchars($food) ?>: <?= htmlspecialchars($quantity) ?> cái</li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <p>Tổng giá: <?= htmlspecialchars($data['total_price']) ?></p>

    <form action="save_ticket.php" method="post">
        <button type="submit">Thanh toán</button>
    </form>
    <button onclick="window.history.back()">Quay lại</button>
</body>
</html>

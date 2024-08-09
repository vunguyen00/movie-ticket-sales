<?php
session_start();

// Đọc dữ liệu từ POST
$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    die(json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']));
}

// Lưu dữ liệu vào SESSION
$_SESSION['booking_details'] = $data;

// Phản hồi JSON
echo json_encode(['success' => true, 'redirect' => 'bill2.php']);
?>

<?php
header('Content-Type: application/json');

include "connectToDatabase.php";

// Lấy screen_id từ URL
$screen_id = $_GET['screen_id'];

// Câu truy vấn để lấy thông tin chỗ ngồi dựa trên screen_id
$sql = "SELECT seat_name, status FROM tblseat WHERE screen_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $screen_id);
$stmt->execute();
$result = $stmt->get_result();

$seats = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
}

echo json_encode(['seats' => $seats]);

$stmt->close();
$conn->close();
?>

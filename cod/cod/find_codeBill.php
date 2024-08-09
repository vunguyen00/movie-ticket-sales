<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code_bill'];

    $checkSql = "SELECT * FROM tblbill WHERE code = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bill = $result->fetch_assoc();
        echo json_encode($bill); 
    } else {
        echo json_encode(['error' => 'Không tìm thấy hóa đơn với mã này.']); 
    }

    $stmt->close();
    $conn->close();
}
?>

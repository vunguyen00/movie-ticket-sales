<?php
// Kết nối đến cơ sở dữ liệu
include "connectToDatabase.php";
require __DIR__ . '/vendor/autoload.php'; // Đảm bảo đường dẫn này đúng

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo mới một spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Thiết lập tiêu đề các cột
$sheet->setCellValue('A1', 'Movie ID');
$sheet->setCellValue('B1', 'Movie Name');
$sheet->setCellValue('C1', 'Doanh Thu');

// Truy vấn dữ liệu từ bảng tblmovie
$sql = "SELECT movie_id, movie_name, doanhThu FROM tblmovie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Bắt đầu từ hàng thứ 2 để chèn dữ liệu

    // Duyệt qua từng dòng dữ liệu và chèn vào spreadsheet
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row['movie_id']);
        $sheet->setCellValue('B' . $rowNumber, $row['movie_name']);
        $sheet->setCellValue('C' . $rowNumber, $row['doanhThu']);
        $rowNumber++;
    }
}

// Thiết lập tiêu đề file Excel và xuất file
$writer = new Xlsx($spreadsheet);
$filename = 'movie_data.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

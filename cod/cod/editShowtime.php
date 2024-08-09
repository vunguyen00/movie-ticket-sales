<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $showtime_id = $_POST['showtime_id'];
    $idPhim2 = $_POST['idPhim2'];
    $thoiGian = $_POST['thoiGian'];
    $date_time = $_POST['date_time'];

    // Check if the showtime_id exists in tblshowtime
    $checkSql = "SELECT COUNT(*) as count FROM tblshowtime WHERE showtime_id='$showtime_id'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Update the showtime record
        $updateSql = "UPDATE tblshowtime SET movie_id='$idPhim2', thoiGian='$thoiGian', date='$date_time' WHERE showtime_id='$showtime_id'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $updateSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: showtime ID does not exist.";
    }

    $conn->close();
}
?>

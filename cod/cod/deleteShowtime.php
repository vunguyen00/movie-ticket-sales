<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $showtime_id = $_POST['showtime_id'];

    // Check if the showtime_id exists in tblshowtime
    $checkSql = "SELECT COUNT(*) as count FROM tblshowtime WHERE showtime_id='$showtime_id'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Delete the showtime record
        $deleteSql = "DELETE FROM tblshowtime WHERE showtime_id='$showtime_id'";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $deleteSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: showtime ID does not exist.";
    }

    $conn->close();
}
?>

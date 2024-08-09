<?php
include "connectToDatabase.php";

$sql = "SELECT * FROM tblShowtime WHERE status='onmovie'";
$result = $conn->query($sql);

$showtime = array();
while ($row = $result->fetch_assoc()) {
    $showtime[] = $row;
}

echo json_encode($showtime);
$conn->close();
?>

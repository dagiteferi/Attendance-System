<?php
session_start();
include 'connect.php';  // Include your connection file

$student_id = $_SESSION['id'];  // assuming you have the student's ID stored in a session variable

$sql = "SELECT * FROM attendance WHERE stat_id = '$student_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Student ID</th><th>Course</th><th>Status</th><th>Date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["stat_id"]. "</td><td>" . $row["course"]. "</td><td>" . $row["st_status"]. "</td><td>" . $row["stat_date"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found";
}
$conn->close();
?>

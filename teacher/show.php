<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student - Attendance</title>
    <meta charset="UTF-8">


</head>
<style>
    .body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #48dbfb;
        font-family: "Ubuntu", sans-serif;
    }

    table {
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        border-collapse: collapse;
        margin-top: 50px;


        font-size: 0.9em;
        font-family: "Ubuntu", sans-serif;
        min-width: 300px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    th,
    td {
        padding: 12px 15px;
    }

    th {
        background-color: #48dbfb;
        color: #ffffff;
        text-align: left;
    }

    tr {
        border-bottom: 1px solid #dddddd;
    }

    tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    tr:last-of-type {
        border-bottom: 2px solid #48dbfb;
    }
</style>

</head>
</body>

</html>
<?php
session_start();
include 'connect.php';

$student_id = $_SESSION['id'];

$sql = "SELECT * FROM attendance WHERE stat_id = '$student_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Student ID</th><th>Course</th><th>Status</th><th>Date</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        echo "<tr><td>" . $row["stat_id"] . "</td><td>" . $row["course"] . "</td><td>" . $row["st_status"] . "</td><td>" . $row["stat_date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found";
}
$conn->close();
?>
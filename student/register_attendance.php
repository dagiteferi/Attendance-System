<?php
session_start(); // Start the session

// Check if the name and ID are set in the session
if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['courseName'])) {
  echo "Name: " . $_SESSION['name'] . "<br>";
  echo "ID: " . $_SESSION['id'] . "<br>";
  echo "courseName:" . $_SESSION['courseName'];
} else {
  echo "No session data found.";
}

if (!isset($_SESSION['id']) || !isset($_SESSION['courseName'])) {
  echo "Required data is missing.";
  exit;
}

$student_id = $_SESSION['id']; // Use the ID from the session
$course = $_SESSION['courseName'];

include 'connect.php';  // Include your connection file

$date = date("Y-m-d");  // get the current date
$status = "Present";  // attendance status

$sql = "INSERT INTO attendance (stat_id, course, st_status, stat_date) VALUES ('$student_id', '$course', '$status', '$date')";

if ($conn->query($sql) === TRUE) {
  echo "Attendance saved successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

<?php
session_start(); // Start the session

// Check if the course name is set in the POST data
if (isset($_POST['courseName'])) {
    // Save the course name in a session variable
    $_SESSION['courseName'] = $_POST['courseName'];
    echo "Course name saved successfully!";
} else {
    echo "No course name found.";
}

<?php
session_start();
if(isset($_POST['courseName'])) {
    $_SESSION['courseName'] = $_POST['courseName'];
    echo "Course name stored successfully!";
}
?>

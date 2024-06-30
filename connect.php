<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'attsystem');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . connect_error());
}

<?php
$host = "localhost"; // Database host (usually localhost)
$username = "root"; // Database username (default is root for XAMPP)
$password = ""; // Database password (empty by default in XAMPP)
$database = "vendor_mang"; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

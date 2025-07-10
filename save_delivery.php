<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "vendor_mang";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$vendor_id = $_POST['vendor_id'];
$delivery_status = $_POST['delivery_status'];
$delivery_date = $_POST['delivery_date'];
$remarks = $_POST['remarks'];
$supplies_delivered = $_POST['supplies_delivered'];

// Prepare SQL query to insert data
$sql = "INSERT INTO delivery_status (vendor_id, delivery_status, delivery_date, remarks, supplies_delivered)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $vendor_id, $delivery_status, $delivery_date, $remarks, $supplies_delivered);

// Execute query and check for success
if ($stmt->execute()) {
    echo "Delivery status updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>

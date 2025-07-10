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
$payment_status = $_POST['payment_status'];
$payment_date = $_POST['payment_date'];
$payment_amount = $_POST['payment_amount'];
$name = $_POST['name'];
$contact_number = $_POST['contact_number'];
$remarks = $_POST['remarks'];

// Prepare SQL query to insert data
$sql = "INSERT INTO payments (vendor_id, payment_status, payment_date, payment_amount, name, contact_number, remarks)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $vendor_id, $payment_status, $payment_date, $payment_amount, $name, $contact_number, $remarks);

// Execute query and check for success
if ($stmt->execute()) {
    echo "Payment status updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>

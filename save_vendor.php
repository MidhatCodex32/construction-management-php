<?php
include 'db_connection.php';

// Fetch combined data from vendors, delivery_status, and payments
$vendor_sql = "
    SELECT 
        v.vendor_id,
        v.name,
        v.contact_number,
        GROUP_CONCAT(DISTINCT ds.supplies_delivered SEPARATOR ', ') AS delivered_items,
        MAX(ds.delivery_status) AS delivery_status,
        MAX(ds.delivery_date) AS latest_delivery_date,
        MAX(p.payment_status) AS payment_status,
        MAX(p.payment_date) AS latest_payment_date,
        SUM(p.payment_amount) AS total_payment_amount
    FROM vendors v
    LEFT JOIN delivery_status ds ON v.vendor_id = ds.vendor_id
    LEFT JOIN payments p ON v.vendor_id = p.vendor_id
    GROUP BY v.vendor_id;
";

// Execute the query
$vendor_result = $conn->query($vendor_sql);

// Update the vendors table with combined information
while ($row = $vendor_result->fetch_assoc()) {
    $update_sql = "
        UPDATE vendors 
        SET 
            supplies = '" . $conn->real_escape_string($row['delivered_items']) . "',
            delivery_status = '" . $conn->real_escape_string($row['delivery_status']) . "',
            latest_delivery_date = '" . $conn->real_escape_string($row['latest_delivery_date']) . "',
            delivered_items = '" . $conn->real_escape_string($row['delivered_items']) . "',
            payment_status = '" . $conn->real_escape_string($row['payment_status']) . "',
            latest_payment_date = '" . $conn->real_escape_string($row['latest_payment_date']) . "',
            total_payment_amount = '" . $conn->real_escape_string($row['total_payment_amount']) . "',
            created_at = NOW()
        WHERE vendor_id = " . $row['vendor_id'] . ";
    ";
    $conn->query($update_sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #357a38;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Vendor Management</h1>
    </div>
    <div class="container">
        <h2>Vendor Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Vendor ID</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Supplies</th>
                    <th>Delivery Status</th>
                    <th>Latest Delivery Date</th>
                    <th>Delivered Items</th>
                    <th>Payment Status</th>
                    <th>Latest Payment Date</th>
                    <th>Total Payment Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch the updated vendor data
                $display_sql = "SELECT * FROM vendors";
                $result = $conn->query($display_sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['vendor_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['contact_number']}</td>
                            <td>{$row['supplies']}</td>
                            <td>{$row['delivery_status']}</td>
                            <td>{$row['latest_delivery_date']}</td>
                            <td>{$row['delivered_items']}</td>
                            <td>{$row['payment_status']}</td>
                            <td>{$row['latest_payment_date']}</td>
                            <td>{$row['total_payment_amount']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No vendor data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>

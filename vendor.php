<?php
include 'db_connection.php';

// SQL query to fetch data dynamically from payments and delivery_status
$vendor_sql = "
    SELECT 
        v.vendor_id,
        COALESCE(MAX(v.name), 'N/A') AS vendor_name,
        COALESCE(MAX(v.contact_number), 'N/A') AS contact_number,
        GROUP_CONCAT(DISTINCT d.supplies_delivered SEPARATOR ', ') AS delivered_items,
        COALESCE(MAX(d.delivery_status), 'N/A') AS delivery_status,
        COALESCE(MAX(d.delivery_date), 'N/A') AS latest_delivery_date,
        COALESCE(MAX(p.payment_status), 'N/A') AS payment_status,
        COALESCE(MAX(p.payment_date), 'N/A') AS latest_payment_date,
        COALESCE(SUM(p.payment_amount), 0) AS total_payment_amount
    FROM vendors v
    LEFT JOIN payments p ON v.vendor_id = p.vendor_id
    LEFT JOIN delivery_status d ON v.vendor_id = d.vendor_id
    GROUP BY v.vendor_id;
";

$vendor_result = $conn->query($vendor_sql);

// Display updated data
$display_sql = "SELECT * FROM vendors";
$result = $conn->query($display_sql);
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
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .btn:hover {
            background-color: #357a38;
        }

        .receipt {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .receipt h2 {
            margin-top: 0;
        }

        .close-btn {
            display: inline-block;
            padding: 5px 10px;
            margin-top: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Vendor Management</h1>
    <table>
        <thead>
            <tr>
                <th>Vendor ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Supplies</th>
                <th>Delivery Status</th>
                <th>Latest Delivery Date</th>
                <th>Payment Status</th>
                <th>Latest Payment Date</th>
                <th>Total Payment Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['vendor_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['supplies']}</td>
                        <td>{$row['delivery_status']}</td>
                        <td>{$row['latest_delivery_date']}</td>
                        <td>{$row['payment_status']}</td>
                        <td>{$row['latest_payment_date']}</td>
                        <td>{$row['total_payment_amount']}</td>
                        <td><button class='btn' onclick='viewReceipt({$row['vendor_id']})'>View Receipt</button></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Receipt Modal -->
    <div class="receipt" id="receipt-modal">
        <h2>Receipt Details</h2>
        <div id="receipt-content"></div>
        <button class="close-btn" onclick="closeReceipt()">Close</button>
    </div>

    <script>
        function viewReceipt(vendorId) {
            const receiptModal = document.getElementById('receipt-modal');
            const receiptContent = document.getElementById('receipt-content');
            
            // Fetch receipt data via AJAX
            fetch(`fetch_receipt.php?vendor_id=${vendorId}`)
                .then(response => response.json())
                .then(data => {
                    let content = `
                        <p><strong>Vendor ID:</strong> ${data.vendor_id}</p>
                        <p><strong>Name:</strong> ${data.vendor_name}</p>
                        <p><strong>Contact Number:</strong> ${data.contact_number}</p>
                        <p><strong>Delivered Items:</strong> ${data.delivered_items}</p>
                        <p><strong>Delivery Status:</strong> ${data.delivery_status}</p>
                        <p><strong>Delivery Date:</strong> ${data.latest_delivery_date}</p>
                        <p><strong>Payment Status:</strong> ${data.payment_status}</p>
                        <p><strong>Payment Date:</strong> ${data.latest_payment_date}</p>
                        <p><strong>Total Payment Amount:</strong> ${data.total_payment_amount}</p>
                    `;
                    receiptContent.innerHTML = content;
                    receiptModal.style.display = 'block';
                });
        }

        function closeReceipt() {
            document.getElementById('receipt-modal').style.display = 'none';
        }
    </script>
</body>
</html>

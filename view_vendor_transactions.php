<?php
include('db.php');

$query = "SELECT * FROM vendor_transactions ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='transaction-card'>";
        echo "<h3>Vendor: " . $row['vendor_name'] . "</h3>";
        echo "<p>Transaction Date: " . $row['transaction_date'] . "</p>";
        echo "<p>Amount: " . $row['amount_received'] . "</p>";
        echo "<p>Created: " . $row['created_at'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No vendor transactions found.";
}
?>

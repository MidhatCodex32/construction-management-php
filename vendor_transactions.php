<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Transactions</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f4f7fc;
      color: #333;
      padding: 20px;
    }

    h1 {
      color: #4CAF50;
    }

    form {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    form label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
    }

    form input, form textarea, form button, form select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    form button:hover {
      background-color: #3e8e41;
    }
  </style>
</head>
<body>
  <h1>Vendor Transactions</h1>
  <form id="vendor-transaction-form" method="POST" action="your-server-endpoint">
    <!-- Dynamic Vendor Name -->
    <label for="vendor-name">Vendor Name:</label>
    <select id="vendor-name" name="vendor-name">
      <!-- Options will be dynamically generated here -->
    </select>

    <!-- Dynamic Date of Transaction -->
    <label for="transaction-date">Transaction Date:</label>
    <input type="date" id="transaction-date" name="transaction-date">

    <!-- Amount Received -->
    <label for="amount-received">Amount Received:</label>
    <input type="number" id="amount-received" name="amount-received" placeholder="Enter amount received" step="0.01">

    <button type="submit">Submit</button>
  </form>

  <script>
    // Example of dynamically populating vendor options
    const vendors = ['XYZ Supplies', 'ABC Construction', 'LMN Traders'];

    // Populate vendor name options dynamically
    const vendorSelect = document.getElementById('vendor-name');
    vendors.forEach(vendor => {
      const option = document.createElement('option');
      option.value = vendor;
      option.textContent = vendor;
      vendorSelect.appendChild(option);
    });

    // Handle form submission dynamically
    document.getElementById('vendor-transaction-form').addEventListener('submit', function (e) {
      e.preventDefault(); // Prevent the default form submission behavior

      const formData = new FormData(this);
      fetch('your-server-endpoint', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response data from your server
        console.log('Form submitted successfully:', data);
      })
      .catch(error => {
        // Handle error
        console.error('Error submitting form:', error);
      });
    });
  </script>
</body>
</html>

<?php
include 'db.php';
?>



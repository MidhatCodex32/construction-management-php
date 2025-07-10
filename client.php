<?php
$conn = new mysqli("localhost", "root", "", "clients_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            padding: 15px 20px;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 28px;
        }

        .header .add-button {
            padding: 10px 20px;
            font-size: 16px;
            color: #4CAF50;
            background-color: white;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .header .add-button:hover {
            background-color:#08860c;
            color: white;
        }

        .container {
            padding: 20px;
        }

        .table-container {
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f6f8;
            font-weight: 600;
        }

        table td {
            background-color: white;
        }

        .form-container {
            display: none;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form input:focus, form textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .form-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .form-container .add-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .form-container .add-button:hover {
            background-color: #45a049;
        }

        .form-container .cancel-button {
            background-color: #f44336;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .form-container .cancel-button:hover {
            background-color: #e53935;
        }
    </style>
    <script>
        function toggleForm() {
            const formContainer = document.getElementById('formContainer');
            const tableContainer = document.getElementById('tableContainer');

            if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                formContainer.style.display = 'block';
                tableContainer.style.display = 'none';
            } else {
                formContainer.style.display = 'none';
                tableContainer.style.display = 'block';
            }
        }

        function addClient(event) {
            event.preventDefault();

            const tableBody = document.querySelector('#tableContainer tbody');
            const clientID = document.getElementById('clientID').value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const contactNumber = document.getElementById('contactNumber').value;
            const address = document.getElementById('address').value;
            const product = document.getElementById('product').value;
            const cnic = document.getElementById('cnic').value;
            const balance = document.getElementById('balance').value;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${clientID}</td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${contactNumber}</td>
                <td>${address}</td>
                <td>${product}</td>
                <td>${cnic}</td>
                <td><img src="placeholder.jpg" alt="Client Image" width="50"></td>
                <td>${balance}</td>
            `;

            tableBody.appendChild(newRow);

            toggleForm();
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Client Management</h1>
    </div>

    <div class="container">
        <div id="tableContainer" class="table-container">
            <h2>Client Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>ClientID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>CNIC</th>
                        <th>Image</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Client data will be dynamically inserted here -->
                    <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['cnic'] ?></td>
                <td><img src="<?= $row['image'] ?>" width="50"></td>
                <td><?= $row['balance'] ?></td>
            </tr>
        <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="formContainer" class="form-container">
            <h2>Add Client</h2>
            <form id="addClientForm" onsubmit="addClient(event)">
                <label for="clientID">Client ID:</label>
                <input type="text" id="clientID" name="clientID" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>

                <label for="cnic">CNIC:</label>
                <input type="text" id="cnic" name="cnic" required>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="balance">Balance:</label>
                <input type="number" id="balance" name="balance" required>

                <button type="submit" class="add-button">Submit</button>
                <button type="button" class="cancel-button" onclick="toggleForm()">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
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
            background-color: #45a049;
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
            padding: 20px;
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

        function addProject(event) {
            event.preventDefault();

            const tableBody = document.querySelector('#tableContainer tbody');
            const projectID = document.getElementById('projectID').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const deadline = document.getElementById('deadline').value;
            const status = document.getElementById('status').value;
            const clientID = document.getElementById('clientID').value;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${projectID}</td>
                <td>${name}</td>
                <td>${description}</td>
                <td>${deadline}</td>
                <td>${status}</td>
                <td>${clientID}</td>
            `;

            tableBody.appendChild(newRow);

            toggleForm();
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Project Management</h1>
       <a href="new_project.php"> <button class="add-button" >Add Project</button></a>
    </div>

    <div class="container">
        <div id="tableContainer" class="table-container">
            <h2>Project Details</h2>
            <table>
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Client Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>CNIC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "clients_db");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the database
            $sql = "SELECT * FROM projects";
            $result = $conn->query($sql);

            // Loop through the records and display them
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['project_name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['deadline'] . "</td>";
                    echo "<td>" . $row['client_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['contact_number'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['cnic'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No projects found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

        </div>

        <div id="formContainer" class="form-container">
            <h2>Add Project</h2>
            <form id="addProjectForm" onsubmit="addProject(event)">
                <label for="projectID">Project ID:</label>
                <input type="text" id="projectID" name="projectID" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required></textarea>

                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" required>

                <label for="status">Status:</label>
                <input type="text" id="status" name="status" required>

                <label for="clientID">Client ID:</label>
                <input type="text" id="clientID" name="clientID" required>

                <button type="submit" class="add-button">Submit</button>
                <button type="button" class="cancel-button" onclick="toggleForm()">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>

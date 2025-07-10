<?php
// Include database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $project_status = $_POST['project-status'];
    $team_assigned = $_POST['team-assigned'];
    $project_details = $_POST['project-details'];

    // Validate the inputs (optional but recommended)
    if (empty($project_status) || empty($team_assigned) || empty($project_details)) {
        die("All fields are required.");
    }

    // Prepare an SQL query to insert data
    $query = "INSERT INTO project_updates (project_status, team_assigned, project_details) 
              VALUES (?, ?, ?)";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $project_status, $team_assigned, $project_details);

    // Execute the query
    if ($stmt->execute()) {
        echo "Project update saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetch all project updates to display in a table
$query = "SELECT * FROM project_updates ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Updates</title>
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

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

  </style>
</head>
<body>
  <h1>Project Updates</h1>
  <form id="project-update-form" method="POST" action="">

    <!-- Dynamic Project Status -->
    <label for="project-status">Project Status:</label>
    <select id="project-status" name="project-status">
      
    </select>

    <!-- Dynamic Team Assignments -->
    <label for="team-assigned">Team Assigned:</label>
    <select id="team-assigned" name="team-assigned">
      <!-- Options dynamically generated -->
     
    </select>

    <!-- Details Section -->
    <label for="project-details">Details:</label>
    <textarea id="project-details" name="project-details" rows="4" placeholder="Enter project details here..."></textarea>

    <button type="submit">Submit</button>
  </form>

  <script>
    // Example of dynamically populating options
    const projectStatuses = ['In Progress', 'Completed', 'Delayed', 'Pending'];
    const teams = ['Team A', 'Team B', 'Team C', 'Team D'];

    // Populate project status options dynamically
    const statusSelect = document.getElementById('project-status');
    projectStatuses.forEach(status => {
      const option = document.createElement('option');
      option.value = status;
      option.textContent = status;
      statusSelect.appendChild(option);
    });

    // Populate team options dynamically
    const teamSelect = document.getElementById('team-assigned');
    teams.forEach(team => {
      const option = document.createElement('option');
      option.value = team;
      option.textContent = team;
      teamSelect.appendChild(option);
    });
  </script>

  <!-- Display Project Updates Table -->
  <h2>Project Updates</h2>
  <table>
    <tr>
      <th>Project Status</th>
      <th>Team Assigned</th>
      <th>Details</th>
      <th>Created At</th>
    </tr>

    <?php
    // Display data from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['project_status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['team_assigned']) . "</td>";
            echo "<td>" . htmlspecialchars($row['project_details']) . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No updates found</td></tr>";
    }
    ?>

  </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
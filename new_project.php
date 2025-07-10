 <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "clients_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit New Project</title>
  <style>
    /* Base styles */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f4f7fc;
      color: #333;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #4CAF50;
      padding: 20px 30px;
      color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
      font-size: 28px;
      margin: 0;
    }

    .container {
      padding: 40px 30px;
      max-width: 800px;
      margin: 40px auto;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #4CAF50;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: 600;
      margin-bottom: 5px;
    }

    input, textarea, button {
      width: 100%;
      padding: 12px 15px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    textarea {
      resize: none;
    }

    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #357a38;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group img {
      margin-top: 10px;
      max-width: 100px;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="header">
    <h1>Submit New Project</h1>
  </div>

  <!-- Form Container -->
  <div class="container">
    <h2>Project Information</h2>
    <form id="project-form" method="POST" action="">
        <div class="form-group">
            <label for="project-name">Project Name</label>
            <input type="text" id="project-name" name="projectName" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" id="deadline" name="deadline" required>
        </div>

        <div class="form-group">
            <label for="client-name">Client Name</label>
            <input type="text" id="client-name" name="clientName" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="contact-number">Contact Number</label>
            <input type="tel" id="contact-number" name="contactNumber" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="cnic">CNIC</label>
            <input type="text" id="cnic" name="cnic" required>
        </div>

        <button type="submit" name="submit">Submit Project Details</button>
    </form>

   
<?php
    // Handle form submission
    if (isset($_POST['submit'])) {
        $projectName = $_POST['projectName'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $clientName = $_POST['clientName'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contactNumber'];
        $address = $_POST['address'];
        $cnic = $_POST['cnic'];

        $sql = "INSERT INTO projects (project_name, description, deadline, client_name, email, contact_number, address, cnic)
                VALUES ('$projectName', '$description', '$deadline', '$clientName', '$email', '$contactNumber', '$address', '$cnic')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Project added successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>

</body>
</html>

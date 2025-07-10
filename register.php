<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    /* Base styles */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f4f7fc;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 400px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .login-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .login-box h2 {
      color: #4CAF50;
      margin-bottom: 30px;
      font-size: 28px;
      font-weight: 600;
    }

    .login-box input {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 16px;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    .login-box input:focus {
      border-color: #4CAF50;
      outline: none;
    }

    .login-box button {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-box button:hover {
      background-color: #357a38;
    }

    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 10px;
      font-weight: 600;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .login-box {
        width: 90%;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
<a href="login.php"><button type="submit"  style="background-color: #4CAF50;" name="add">GO BACK</button></a>
  <div class="login-box">
  <h2>Register</h2>

<!-- Form -->
<form method="POST" action="" enctype="multipart/form-data">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" required>
  
  <label for="email">Email:</label>
  <input type="email" name="email" id="email" required>
  
  <label for="contact">Contact:</label>
  <input type="text" name="contact" id="contact" maxlength="12"  required  >
  
  <label for="address">Address:</label>
  <input type="text" name="address" id="address" required>
  
  <label for="cnic">CNIC:</label>
  <input type="text" name="cnic" id="cnic" required>
  
  <label for="image">Upload Image:</label>
  <input type="file" name="image" id="image" accept=".png" required>
  
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" required>
  
  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required>

  <button type="submit" name="add">Add Client</button>

   


</form>
</div>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "clients_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $cnic = $_POST['cnic'];
    $username =$_POST['username'];
    $password =$_POST['password'];

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "assets/images/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image type
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Save file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO clients (name, email, contact, address, cnic, image,username,password) 
                        VALUES ('$name', '$email', '$contact', '$address', '$cnic', '$target_file','$username',' $password')";
                if ($conn->query($sql) === TRUE) {
                    // Redirect to client_dashboard.php
                    header("Location: client_dashboard.php");
                    exit; // Ensure no further code is executed after redirection
                } else {
                    echo "<p>Error: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>Error uploading the image.</p>";
            }
        } else {
            echo "<p>The file is not a valid image.</p>";
        }
    } else {
        echo "<p>No image file uploaded or an error occurred.</p>";
    }
}

$conn->close();
?>

</body>
</html>
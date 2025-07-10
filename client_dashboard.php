<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Dashboard</title>
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

    .header .user {
      display: flex;
      align-items: center;
      position: relative;
    }

    .header .user img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
      border: 2px solid white;
      cursor: pointer;
    }

    .header .user span {
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
    }

    /* Dropdown Menu */
    .user .dropdown {
      display: none;
      position: absolute;
      right: 0;
      top: 60px;
      background-color: white;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 10px;
      width: 200px;
      z-index: 100;
    }

    .user:hover .dropdown {
      display: block;
    }

    .dropdown a {
      display: block;
      padding: 10px;
      color: #333;
      text-decoration: none;
      font-size: 16px;
      margin: 5px 0;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .dropdown a:hover {
      background-color: #f4f4f9;
    }

    .notification-badge {
      background-color: #FF6347;
      color: white;
      font-size: 14px;
      padding: 3px 8px;
      border-radius: 50%;
      position: absolute;
      top: 0;
      right: 0;
      display: none; /* Initially hidden */
    }

    /* Container */
    .container {
      padding: 40px 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Dashboard Cards */
    .cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .card {
      background: linear-gradient(145deg, #ffffff, #f4f4f9);
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      margin-top: 50px;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card img {
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
    }

    .card h3 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #4CAF50;
      font-weight: 600;
    }

    .card p {
      font-size: 16px;
      color: #666;
      margin-bottom: 20px;
    }

    .card .btn {
      padding: 12px 25px;
      font-size: 16px;
      color: white;
      background-color: #4CAF50;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      cursor: pointer;
      margin-top: 20px;
    }

    .card .btn:hover {
      background-color: rgb(29, 78, 170);
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .cards {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .cards {
        grid-template-columns: 1fr;
      }

      .container h2 {
        font-size: 26px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="header">
    <h1>Client Dashboard</h1>
    <div class="user">
      <img id="profile-img" src="https://via.placeholder.com/50" alt="User Avatar">
      <span>User Name</span>
      <!-- Notifications Link with Badge -->
      <div class="dropdown">
        <a href="notifications.html">
          Notifications
          <!-- Notification Badge (Showing 0 notifications) -->
          <div class="notification-badge notification-badge-active" id="notification-badge">0</div>
        </a>
        <a href="javascript:void(0);" onclick="document.getElementById('file-input').click()">Change Profile Picture</a>
        <a href="javascript:void(0);" onclick="signOut()">Sign Out</a>
      </div>
    </div>
  </div>

  <!-- File Input for Profile Picture (hidden) -->
  <input type="file" id="file-input" style="display: none;" onchange="updateProfilePicture(event)">

  <!-- Main Container -->
  <div class="container">

    <div class="cards">
      <!-- Payment Card -->
      <div class="card">
          <img src="./assets/images/payment-method.png" alt="Payment Icon">
          <h3>Payment</h3>
          <p>Pay your invoices online using secure payment methods.</p>
          <a href="payment.html" class="btn">Make a Payment</a>
      </div>
    
      <!-- New Project Card -->
      <div class="card">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Project Icon">
        <h3>New Project</h3>
        <p>Submit details of your new project order and requirements.</p>
        <a href="new_project.php" class="btn">Submit New Project</a>
      </div>

      <!-- View Project Status Card -->
      <div class="card">
        <img src="./assets/images/status-update.png" alt="Status Icon">
        <h3>View Status</h3>
        <p>Check the current status of your ongoing projects.</p>
        <a href="view_project_status.html" class="btn">View Status</a>
      </div>
    </div>
  </div>

  <script>
    // Function to update profile picture
    function updateProfilePicture(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profile-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }

    // Sign-out function
    function signOut() {
      // You can remove any session data here (like cookies or localStorage if applicable)
      alert("You have been signed out.");
      // Redirect to login page
      window.location.href = "login.php";
    }
  </script>
</body>
</html>

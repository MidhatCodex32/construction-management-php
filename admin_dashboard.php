<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
      cursor: pointer;
    }

    .header .user img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
      border: 2px solid white;
      transition: transform 0.3s ease;
    }

    .header .user img:hover {
      transform: scale(1.1);
    }

    .header .user span {
      font-size: 18px;
      font-weight: 600;
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

    /* Notification Badge on Notifications link */
    .dropdown .notification-badge {
      background-color: #FF6347;
      color: white;
      font-size: 14px;
      padding: 3px 8px;
      border-radius: 50%;
      position: absolute;
      top: 5px;
      right: 10px;
    }

    .notification-badge-zero {
      display: none;
    }

    .notification-badge-active {
      display: block;
    }

    .container {
      padding: 40px 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .container h2 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 40px;
      color: #333;
    }

    /* Adjust grid layout to have 3 cards per row */
    .cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 columns per row */
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
      margin-top: 30px;
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

    .card .btn:hover{
      background-color: rgb(29, 78, 170);
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
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .cards {
        grid-template-columns: repeat(2, 1fr); /* 2 columns per row on medium screens */
      }
    }

    @media (max-width: 768px) {
      .cards {
        grid-template-columns: 1fr; /* 1 column per row on small screens */
      }

      .container h2 {
        font-size: 26px;
      }

      .card img {
        width: 70px;
        height: 70px;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Dashboard</h1>
    <div class="user">
      <img id="profile-img" src="https://via.placeholder.com/50" alt="User Avatar">
      <span>Project Manager</span>
      <div class="dropdown">
        <a href="notifications.html">Notifications
          <!-- Notification Badge (Showing 0 notifications) -->
          <div class="notification-badge notification-badge-active">0</div>
        </a>
        <a href="javascript:void(0);" onclick="document.getElementById('file-input').click()">Change Profile Picture</a>
        <a href="javascript:void(0);" onclick="logout()">Sign Out</a>
      </div>
    </div>
  </div>

  <!-- File Input for Profile Picture -->
  <input type="file" id="file-input" style="display: none;" onchange="updateProfilePicture(event)">

  <div class="container">

    <div class="cards">
      <div class="card">
        <img src="./assets/images/owner.png" alt="Clients Icon">
        <h3>Clients</h3>
        <p>Manage client details, view balances, and track activities.</p>
        <a href="client.php" class="btn">View Clients</a>
      </div>
      <div class="card">
        <img src="./assets/images/project.png" alt="Projects Icon">
        <h3>Projects</h3>
        <p>Monitor ongoing projects and allocate resources effectively.</p>
        <a href="project.php" class="btn">View Projects</a>
      </div>
      <div class="card">
        <img src="./assets/images/vendor (1).png" alt="Vendors Icon">
        <h3>Vendors</h3>
        <p>Check vendor details, track orders, and manage payments.</p>
        <a href="vendor.php" class="btn">View Vendors</a>
      </div>
      <div class="card">
        <img src="https://cdn-icons-png.flaticon.com/512/1019/1019643.png" alt="Payments Icon">
        <h3>Payments</h3>
        <p>Track payments and maintain financial records efficiently.</p>
        <a href="payments.html" class="btn">View Payments</a>
      </div>
      <div class="card">
        <img src="./assets/images/tool-box.png" alt="Products Icon">
        <h3>Products</h3>
        <p>Check product details, track orders, and manage inventory.</p>
        <a href="product.html" class="btn">View Products</a>
      </div>
      <div class="card">
        <img src="./assets/images/task-management.png" alt="Project Managers Icon">
        <h3>Supervisor</h3>
        <p>Oversee teams and ensure tasks are completed efficiently and effectively.</p>
        <a href="projectmanager.html" class="btn">View Supervisor</a>
      </div>
    </div>
  </div>

  <script>
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

    // Logout function
    function logout() {
      // You can clear local storage or session data if needed
      // For example:
      localStorage.removeItem('userSession');
      // Redirect to the login page or a logout confirmation page
      window.location.href = 'login.php';
    }
  </script>
</body>
</html>

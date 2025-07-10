<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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

    .role-selection {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
    }

    .role-button {
      padding: 12px 30px;
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .role-button:hover {
      background-color: #357a38;
    }

    .login-form-container {
      display: none;
      margin-top: 20px;
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

    .back-button1 {
      position: fixed;
      bottom: 20px;
      left: 20px;
      text-decoration: none;
      font-size: 16px;
      color: white;
      background-color: #4CAF50;
      padding: 10px 20px;
      border-radius: 8px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .back-button1:hover {
      background-color: #357a38;
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
  <div class="login-box">
    <h2>Login</h2>
    <div id="role-selection">
      <p>Please select your role:</p>
      <div class="role-selection">
        <button class="role-button" onclick="selectRole('admin')">Admin</button>
        <button class="role-button" onclick="selectRole('client')">Client</button>
        <button class="role-button" onclick="selectRole('supervisor')">Supervisor</button>
        <button class="role-button" onclick="selectRole('vendor')">Vendor</button>
      </div>
    </div>

    <!-- Login Form (Initially Hidden) -->
    <div id="login-form-container" class="login-form-container">
      <form id="login-form">
        <div>
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div>
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit">Login</button>
        <a href="register.php" style="display: block; margin-top: 10px; color: #4CAF50;">Register Now</a>
        <div id="error-message" class="error-message"></div>
      </form>
    </div>
  
  </div>
    <div><a href="login.php" class="back-button1">Back</a></div>

  <script>
    // Dummy users for simulation
    const users = {
      admin: { username: 'admin', password: 'admin123', role: 'admin' },
      client: { username: 'client', password: 'client123', role: 'client' },
      supervisor: { username: 'supervisor', password: 'supervisor123', role: 'supervisor' },
      vendor: { username: 'vendor', password: 'vendor123', role: 'vendor' },
    };

    // Function to show the login form after selecting the role
    function selectRole(role) {
      // Hide the role selection section
      document.getElementById('role-selection').style.display = 'none';

      // Show the login form
      const formContainer = document.getElementById('login-form-container');
      formContainer.style.display = 'block';

      // Update form based on the selected role
      const form = document.getElementById('login-form');
      form.setAttribute('data-role', role);
    }

    // Handle login form submission
    document.getElementById('login-form').addEventListener('submit', function(event) {
      event.preventDefault();

      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      const role = document.getElementById('login-form').getAttribute('data-role');

      // Check if the entered credentials match the selected role
      if (users[role] && users[role].username === username && users[role].password === password) {
        // Determine file extension based on role
        const fileExtension = (role === 'supervisor' || role === 'vendor') ? 'html' : 'php';

        // Redirect to the respective dashboard
        window.location.href = `${role}_dashboard.${fileExtension}`;
      } 
      else {
        // Show error message for incorrect credentials
        document.getElementById('error-message').textContent = 'Invalid username or password. Please try again.';
      }
    });
  </script>
</body>
</html>

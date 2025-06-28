<?php
session_start();
include "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid Credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - AI Fitness Coach</title>
  <style>
    * {
      cursor: none;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Garamond', serif;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #ffffff, #cbe5ff);
      color: #003366;
      transition: background 0.3s, color 0.3s;
    }

    .container {
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      text-align: center;
      position: relative;
      z-index: 2;
    }

    h2 {
      font-size: 32px;
      margin-bottom: 20px;
      color: #003366;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    button {
      padding: 12px 25px;
      background-color: #0066cc;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 18px;
      margin-top: 10px;
    }

    button:hover {
      background-color: #004080;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
    }

    a {
      color: #003366;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    #dark-mode-toggle {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      background: none;
      border: none;
      cursor: pointer;
      z-index: 3;
    }

    /* Background bubbles animation */
    .bubbles {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      overflow: hidden;
      z-index: 1;
    }

    .bubbles span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(0, 102, 204, 0.3);
      border-radius: 50%;
      animation: rise 15s linear infinite;
      bottom: -150px;
    }

    .bubbles span:nth-child(odd) {
      background: rgba(0, 102, 204, 0.1);
    }

    @keyframes rise {
      0% {
        transform: translateY(0) scale(1);
        opacity: 1;
      }
      100% {
        transform: translateY(-1000px) scale(0.5);
        opacity: 0;
      }
    }

    .cursor {
      width: 25px;
      height: 25px;
      border: 2px solid #0066cc;
      border-radius: 50%;
      position: fixed;
      pointer-events: none;
      transform: translate(-50%, -50%);
      transition: all 0.1s ease;
      z-index: 9999;
    }

    /* Dark mode */
    body.dark-mode {
      background: #001f33;
      color: #ffffff;
    }

    .container.dark-mode {
      background: rgba(0, 0, 0, 0.85);
      color: white;
    }
  </style>
</head>
<body>
<!-- Background Bubbles -->
<div class="bubbles">
  <?php for ($i = 0; $i < 50; $i++): ?>
    <span style="left: <?= rand(0, 100) ?>%; animation-duration: <?= rand(10, 30) ?>s; animation-delay: <?= rand(0, 20) ?>s;"></span>
  <?php endfor; ?>
</div>

<!-- Custom Cursor -->
<div class="cursor" id="cursor"></div>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<!-- Login Form -->
<div class="container" id="login-box">
  <h2>Login</h2>
  <?php if (isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
  <form method="POST">
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="register.php">Sign up</a></p>
</div>

<script>
  // Dark Mode
  const toggle = document.getElementById('dark-mode-toggle');
  toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    document.getElementById('login-box').classList.toggle('dark-mode');
    toggle.textContent = document.body.classList.contains('dark-mode') ? '🌞' : '🌙';
  });

  // Custom Cursor
  const cursor = document.getElementById("cursor");
  document.addEventListener("mousemove", (e) => {
    cursor.style.left = e.pageX + "px";
    cursor.style.top = e.pageY + "px";
  });
</script>
</body>
</html>

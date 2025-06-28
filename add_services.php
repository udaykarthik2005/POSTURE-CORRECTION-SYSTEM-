<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness & Well-Being</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/script.js" defer></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Dark Mode Toggle */
        #dark-mode-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        /* Time & Date */
        #datetime {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            background: url('https://source.unsplash.com/1600x900/?fitness,gym') center/cover no-repeat;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }

        .hero h1 {
            font-size: 36px;
        }

        /* Navigation Bar */
        .navbar {
            background: #007BFF;
            padding: 15px;
            text-align: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 18px;
        }

        .navbar a:hover {
            background: #0056b3;
            border-radius: 5px;
        }

        /* Features Section */
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .feature-card {
            background: white;
            padding: 20px;
            margin: 15px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        /* Footer */
        footer {
            background: #333;
            color: white;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Date & Time -->
<div id="datetime"></div>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<!-- Hero Section -->
<header class="hero">
    <h1>Welcome to Your AI Fitness & Well-Being Hub</h1>
</header>

<!-- Navigation Bar -->
<nav class="navbar">
    <a href="diet_home.php">🥗 Diet Plans</a>
    <a href="chatbot.php">🤖 AI Chatbot</a>
    <a href="profile.php">👤 Profile</a>
    <a href="pages/calorie_tracker.php">🔥 Calorie Tracker</a>
    <a href="pages/dashboard.php">📊 Dashboard</a>
    <a href="workout_logging.php">🏋️‍♂️ Log Workouts</a>
</nav>

<!-- Features Section -->
<section class="features">
    <div class="feature-card">
        <h2>📌 AI-Powered Diet Plans</h2>
        <p>Get customized meal plans based on your health goals.</p>
    </div>
    <div class="feature-card">
        <h2>🏋️‍♂️ Workout Suggestions</h2>
        <p>Smart exercise recommendations tailored for you.</p>
    </div>
    <div class="feature-card">
        <h2>🔥 Calorie Tracking</h2>
        <p>Monitor your daily intake and stay on top of your fitness.</p>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Fitness Hub. All rights reserved.</p>
</footer>

</body>
</html>

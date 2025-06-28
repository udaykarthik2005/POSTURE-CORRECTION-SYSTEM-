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
    <script defer src="assets/js/script.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: Garamond;
            background: linear-gradient(-45deg, #f4f4f4, #ddd, #f4f4f4);
            background-size: 400% 400%;
            animation: gradientBG 10s infinite alternate;
            color: black;
            margin: 0;
            padding: 0;
            text-align: center;
            transition: background 0.3s, color 0.3s;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background: #222;
            color: white;
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
            background: url('https://images.pexels.com/photos/1162519/pexels-photo-1162519.jpeg') center/cover no-repeat;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            animation: fadeIn 2s ease-in-out;
        }

        .hero h1 {
            font-size: 36px;
            animation: textFade 3s infinite alternate;
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
            transition: transform 0.3s ease, background 0.3s;
            display: inline-block;
        }

        .navbar a:hover {
            background: #0056b3;
            border-radius: 5px;
            transform: scale(1.1);
        }

        /* Features Section */
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .feature-card {
            background: rgba(1, 253, 85, 0.1);
            padding: 20px;
            margin: 15px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }

        /* Footer */
        footer {
            background: #333;
            color: white;
            padding: 15px;
            margin-top: 20px;
        }

        /* Keyframe Animations */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        @keyframes textFade {
            0% { opacity: 1; }
            100% { opacity: 0.6; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
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
    <a href="calorie_tracker.php">🔥 Calorie Tracker</a>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="workout_logging.php">🏋️‍♂️ Log Workouts</a>
    <a href="posture_checker.html">🪑 Posture Tracker</a>


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

<script>
    // Live updating Date & Time
    function updateDateTime() {
        const date = new Date();
        document.getElementById('datetime').textContent = date.toLocaleString();
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
        darkModeToggle.textContent = "🌞";
    }

    darkModeToggle.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
            darkModeToggle.textContent = "🌞";
        } else {
            localStorage.setItem("darkMode", "disabled");
            darkModeToggle.textContent = "🌙";
        }
    });
</script>

</body>
</html>

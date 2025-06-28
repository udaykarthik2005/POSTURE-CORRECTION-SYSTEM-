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
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Garamond', serif;
            background: linear-gradient(-45deg, #0d0d0d, #1a0000, #330000, #1a0000);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #f5f5f5;
            text-align: center;
        }

        #dark-mode-toggle {
            position: fixed;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            color: #f5f5f5;
            cursor: pointer;
            z-index: 1000;
        }

        #datetime {
            position: fixed;
            top: 15px;
            left: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #f5f5f5;
            z-index: 1000;
        }

        .hero {
            background: url('https://images.pexels.com/photos/1162519/pexels-photo-1162519.jpeg') center/cover no-repeat;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.9);
        }

        .hero h1 {
            font-size: 2.5rem;
            animation: fadeIn 2s ease-out;
        }

        .navbar {
            display: flex;
            justify-content: center;
            background: rgba(255, 0, 0, 0.2);
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 999;
            backdrop-filter: blur(10px);
        }

        .navbar a {
            color: #f5f5f5;
            text-decoration: none;
            margin: 0 10px;
            padding: 6px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .navbar a:hover {
            background: rgba(255, 0, 0, 0.6);
            transform: scale(1.05);
        }

        .content {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(0,0,0,0.4);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
        }

        .content h2 {
            color: #ff4d4d;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
            line-height: 1.8;
            color: #e0e0e0;
        }

        footer {
            background: #111;
            padding: 15px;
            color: #888;
            font-size: 14px;
            margin-top: 50px;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div id="datetime"></div>
    <button id="dark-mode-toggle">🌙</button>

    <header class="hero">
        <h1>Welcome to Your AI Fitness & Well-Being Hub</h1>
    </header>

    <nav class="navbar">
        <a href="diet_home.php">🥗 Diet</a>
        <a href="chatbot.php">🤖 Chat</a>
        <a href="profile.php">👤 Profile</a>
        <a href="calorie_tracker.php">🔥 Tracker</a>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="workout_logging.php">🏋️‍♂️ Log</a>
        <a href="posture_checker.html">🪑 Posture</a>
    </nav>

    <div class="content">
        <h2>Live Healthy. Stay Strong. Thrive Daily.</h2>
        <p>
            Embracing a healthy lifestyle is more than just exercising or eating right—it's about balance. Consistency in good habits like hydration, mindful eating, and regular physical activity can uplift your energy levels and improve mental clarity.
        </p>
        <p>
            Make small changes each day. Whether it’s choosing stairs over the elevator or cutting back on sugar, each action counts. With time, these choices build into powerful habits that enhance longevity and happiness.
        </p>
        <p>
            Remember, true well-being comes from a combination of physical fitness, mental health, and self-awareness. Let this platform be your digital coach, guiding you toward a more empowered and healthier version of yourself.
        </p>
    </div>

    <footer>
        <p>&copy; 2025 Fitness Hub. All rights reserved.</p>
    </footer>

    <script>
        function updateDateTime() {
            const date = new Date();
            document.getElementById('datetime').textContent = date.toLocaleString();
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();

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

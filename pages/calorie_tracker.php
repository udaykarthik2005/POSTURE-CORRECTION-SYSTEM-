<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Tracker</title>
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

        /* Workout Selection Grid */
        .workout-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 40px;
            text-align: center;
        }

        .workout-card {
            padding: 20px;
            background-color: #007BFF;
            color: white;
            font-size: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .workout-card:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Keyframe Animations */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
    </style>
</head>
<body>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<h1>Select Your Workout</h1>

<!-- Workout Selection Grid -->
<div class="workout-grid">
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Weightlifting'">Weightlifting</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Jogging'">Jogging</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Skipping'">Skipping</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Cycling'">Cycling</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Yoga'">Yoga</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Boxing'">Boxing</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Running'">Running</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Swimming'">Swimming</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Push-ups'">Push-ups</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Pull-ups'">Pull-ups</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Plank'">Plank</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Jumping Jacks'">Jumping Jacks</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Squats'">Squats</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Leg Raises'">Leg Raises</div>
    <div class="workout-card" onclick="location.href = 'start_calorie_tracker.html?workout=Burpees'">Burpees</div>
</div>

<script>
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

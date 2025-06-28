<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS workout_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    exercise VARCHAR(255) NOT NULL,
    sets INT NOT NULL,
    reps INT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sql = "CREATE TABLE IF NOT EXISTS calorie_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    food VARCHAR(255) NOT NULL,
    calories INT NOT NULL,
    type ENUM('intake', 'burn') NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sql = "CREATE TABLE IF NOT EXISTS health_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    heart_rate INT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);
?>

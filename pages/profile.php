<?php
session_start();
include "../includes/db.php";


// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = "SELECT name, email, age, weight, height, ph_no, goals FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Function to calculate profile completion percentage
function calculateProgress($user) {
    $totalFields = 7; // Total fields
    $filledFields = 0;

    foreach ($user as $field) {
        if (!empty($field)) {
            $filledFields++;
        }
    }

    return ($filledFields / $totalFields) * 100;
}

$progress = calculateProgress($user);

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $ph_no = $_POST['ph_no'];
    $goals = $_POST['goals'];

    $update_query = "UPDATE users SET name='$name', age='$age', weight='$weight', height='$height', ph_no='$ph_no', goals='$goals' WHERE id='$user_id'";
    mysqli_query($conn, $update_query);

    // Refresh the page to show updated progress
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .progress-container {
            width: 100%;
            background-color: #ddd;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .progress-bar {
            width: <?= $progress ?>%;
            height: 20px;
            background-color: <?= ($progress == 100) ? '#4CAF50' : '#ff9800' ?>;
            text-align: center;
            line-height: 20px;
            color: white;
            font-weight: bold;
            transition: width 0.5s ease-in-out;
        }
        .edit-form {
            display: <?= ($progress == 100) ? 'none' : 'block' ?>;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .logout-link {
            text-align: center;
            margin-top: 20px;
        }
        .logout-link a {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>👤 Your Profile</h2>

        <div class="progress-container">
            <div class="progress-bar"><?= round($progress) ?>%</div>
        </div>

        <div class="profile-info">
            <p><strong>Name:</strong> <?= !empty($user['name']) ? $user['name'] : "Not provided" ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <p><strong>Age:</strong> <?= !empty($user['age']) ? $user['age'] : "Not provided" ?></p>
            <p><strong>Weight:</strong> <?= !empty($user['weight']) ? $user['weight'] . " kg" : "Not provided" ?></p>
            <p><strong>Height:</strong> <?= !empty($user['height']) ? $user['height'] . " cm" : "Not provided" ?></p>
            <p><strong>Phone:</strong> <?= !empty($user['ph_no']) ? $user['ph_no'] : "Not provided" ?></p>
            <p><strong>Goals:</strong> <?= !empty($user['goals']) ? $user['goals'] : "Not provided" ?></p>
        </div>

        <!-- If details are missing, show the form -->
        <div class="edit-form">
            <h3>Complete Your Profile</h3>
            <form method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?= $user['name'] ?? '' ?>" required>

                <label for="age">Age:</label>
                <input type="number" name="age" value="<?= $user['age'] ?? '' ?>" required>

                <label for="weight">Weight (kg):</label>
                <input type="number" name="weight" value="<?= $user['weight'] ?? '' ?>" required>

                <label for="height">Height (cm):</label>
                <input type="number" name="height" value="<?= $user['height'] ?? '' ?>" required>

                <label for="ph_no">Phone Number:</label>
                <input type="text" name="ph_no" value="<?= $user['ph_no'] ?? '' ?>" required>

                <label for="goals">Fitness Goals:</label>
                <input type="text" name="goals" value="<?= $user['goals'] ?? '' ?>" required>

                <button type="submit">Update Profile</button>
            </form>
        </div>

        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

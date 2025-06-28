<?php
include "../includes/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $ph_no = mysqli_real_escape_string($conn, $_POST['ph_no']);
    $password = $_POST['password'];
    
    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<p style='color: red; text-align: center;'>Email already exists! Try another.</p>";
    } else {
        // Insert user data into database
        $query = "INSERT INTO users (name, email, age, weight, height, ph_no, password) 
                  VALUES ('$name', '$email', '$age', '$weight', '$height', '$ph_no', '$hashed_password')";

        if (mysqli_query($conn, $query)) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Registration failed! Please try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="number" name="weight" placeholder="Weight (kg)" required>
        <input type="number" name="height" placeholder="Height (cm)" required>
        <input type="tel" name="ph_no" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

<script src="../assets/js/script.js"></script>
</body>
</html>

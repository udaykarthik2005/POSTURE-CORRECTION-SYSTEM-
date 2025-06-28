<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exercise = $_POST["exercise"];
    $sets = $_POST["sets"];
    $reps = $_POST["reps"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO workout_log (user_id, exercise, sets, reps) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $user_id, $exercise, $sets, $reps);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Log</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Workout Progress Tracking</h1>
</header>

<form method="POST">
    <label>Exercise:</label>
    <input type="text" name="exercise" required>
    
    <label>Sets:</label>
    <input type="number" name="sets" required>

    <label>Reps:</label>
    <input type="number" name="reps" required>

    <button type="submit">Log Workout</button>
</form>

<h2>Your Workout History</h2>
<table>
    <tr>
        <th>Exercise</th>
        <th>Sets</th>
        <th>Reps</th>
        <th>Date</th>
    </tr>
    <?php
    $user_id = $_SESSION["user_id"];
    $result = $conn->query("SELECT * FROM workout_log WHERE user_id = $user_id ORDER BY date DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['exercise']}</td><td>{$row['sets']}</td><td>{$row['reps']}</td><td>{$row['date']}</td></tr>";
    }
    ?>
</table>

</body>
</html>

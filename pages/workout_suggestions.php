<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$goal = isset($_POST['goal']) ? $_POST['goal'] : "weight_loss";

$api_url = "http://localhost:5000/suggest_workout";
$data = json_encode(["goal" => $goal]);

$options = [
    "http" => [
        "header"  => "Content-type: application/json\r\n",
        "method"  => "POST",
        "content" => $data,
    ],
];

$context  = stream_context_create($options);
$response = file_get_contents($api_url, false, $context);
$result = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Suggestions</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<div class="container">
    <h2>AI-Based Workout Suggestions</h2>

    <form method="POST">
        <label for="goal">Choose Your Fitness Goal:</label>
        <select name="goal">
            <option value="weight_loss">Weight Loss</option>
            <option value="muscle_gain">Muscle Gain</option>
            <option value="endurance">Endurance Training</option>
        </select>
        <button type="submit">Get Workout Suggestion</button>
    </form>

    <?php if (isset($result)): ?>
        <h3>Suggested Workout:</h3>
        <p><?php echo $result["workout_suggestion"]; ?></p>
    <?php endif; ?>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>

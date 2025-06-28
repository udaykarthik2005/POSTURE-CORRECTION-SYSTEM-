<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// User's fitness goal
$goal = isset($_POST['goal']) ? $_POST['goal'] : "maintenance";

$api_url = "http://localhost:5000/recommend";
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
    <title>AI Recommendations</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<div class="container">
    <h2>AI-Based Diet & Workout Plan</h2>

    <form method="POST">
        <label for="goal">Choose Your Fitness Goal:</label>
        <select name="goal" id="goal">
            <option value="weight_loss">Weight Loss</option>
            <option value="muscle_gain">Muscle Gain</option>
            <option value="maintenance">Maintain Health</option>
        </select>
        <button type="submit">Get Recommendations</button>
    </form>

    <?php if (isset($result)): ?>
        <h3>Your Recommended Diet:</h3>
        <p><?php echo $result["diet"]; ?></p>

        <h3>Your Recommended Workout:</h3>
        <p><?php echo $result["workout"]; ?></p>
    <?php endif; ?>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>

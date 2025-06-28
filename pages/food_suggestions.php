<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$goal = isset($_POST['goal']) ? $_POST['goal'] : "balanced";

$api_url = "http://localhost:5000/suggest_food";
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
    <title>Food Suggestions</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<!-- Dark Mode Toggle -->
<button id="dark-mode-toggle">🌙</button>

<div class="container">
    <h2>AI-Based Smart Food Suggestions</h2>

    <form method="POST">
        <label for="goal">Choose Your Dietary Goal:</label>
        <select name="goal">
            <option value="low_calorie">Low Calorie</option>
            <option value="protein_rich">Protein Rich</option>
            <option value="balanced">Balanced Diet</option>
        </select>
        <button type="submit">Get Food Suggestion</button>
    </form>

    <?php if (isset($result)): ?>
        <h3>Suggested Food:</h3>
        <p><?php echo $result["food_suggestion"]; ?></p>
    <?php endif; ?>

</div>

<script src="../assets/js/script.js"></script>
</body>
</html>

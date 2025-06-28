<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$query = "SELECT weight, height FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$weight = isset($user['weight']) ? $user['weight'] : '';
$height = isset($user['height']) ? $user['height'] : '';
$bmi = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    if (!empty($weight) && !empty($height)) {
        $height_m = $height / 100;
        $bmi = round($weight / ($height_m * $height_m), 2);
    }

    $update_query = "UPDATE users SET weight = '$weight', height = '$height' WHERE id = '$user_id'";
    mysqli_query($conn, $update_query);
}

function getDietPlan($bmi) {
    if ($bmi < 18.5) {
        return [
            "title" => "Protein-Rich Diet Plan (For Weight Gain)",
            "image" => "protein_diet.jpg",
            "foods" => ["Eggs 🥚", "Chicken Breast 🍗", "Salmon 🐟", "Nuts 🥜", "Greek Yogurt 🍦", "Milk 🥛", "Lentils 🍛", "Cottage Cheese 🧀"]
        ];
    } elseif ($bmi >= 18.5 && $bmi <= 25.5) {
        return [
            "title" => "Balanced Diet Plan (For Maintenance)",
            "image" => "balanced_diet.jpg",
            "foods" => ["Lean Meat 🍖", "Whole Grains 🍞", "Leafy Greens 🥗", "Fruits 🍎", "Dairy 🥛", "Nuts 🥜", "Healthy Fats 🥑", "Legumes 🌰"]
        ];
    } else {
        return [
            "title" => "Low-Fat & High-Fiber Diet (For Weight Loss)",
            "image" => "low_fat_diet.jpg",
            "foods" => ["Oats 🥣", "Leafy Greens 🥬", "Fruits 🍉", "Lean Chicken 🍗", "Fish 🐠", "Nuts (Moderate) 🥜", "Quinoa 🍚", "Low-Fat Yogurt 🍦"]
        ];
    }
}

$selectedDiet = $bmi ? getDietPlan($bmi) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0d0d0d;
            color: #ff4d4d;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            background: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
            color: #fff;
        }
        h2, h3, h4 {
            color: #ff3333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
            color: #ccc;
        }
        input {
            width: 95%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #333;
            color: #fff;
            font-size: 16px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #ff1a1a;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        button:hover {
            background: #e60000;
        }
        .diet-plan {
            margin-top: 30px;
            background: #262626;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 77, 77, 0.3);
        }
        .diet-plan img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #333;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            font-size: 16px;
            color: #ffcccc;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Check Your BMI & Get a Diet Plan</h2>
    <form method="POST">
        <label for="weight">Enter Your Weight (kg):</label>
        <input type="number" id="weight" name="weight" value="<?= $weight ?>" required>

        <label for="height">Enter Your Height (cm):</label>
        <input type="number" id="height" name="height" value="<?= $height ?>" required>

        <button type="submit">Calculate BMI</button>
    </form>

    <?php if ($bmi): ?>
        <div class="diet-plan">
            <h3>Your BMI: <?= $bmi ?></h3>
            <h4><?= $selectedDiet["title"] ?></h4>
            <img src="../assets/images/<?= $selectedDiet['image'] ?>" alt="Diet Plan">
            <ul>
                <?php foreach ($selectedDiet["foods"] as $food): ?>
                    <li><?= $food ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

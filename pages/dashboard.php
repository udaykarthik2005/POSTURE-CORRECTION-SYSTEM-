<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Get Workout Data
$workout_data = $conn->query("SELECT date, SUM(sets * reps) as total_reps FROM workout_log WHERE user_id = $user_id GROUP BY date");

// Get Calorie Data
$calorie_data = $conn->query("SELECT date, SUM(calories) as total_calories, type FROM calorie_log WHERE user_id = $user_id GROUP BY date, type");

// Convert Data to Arrays
$workout_dates = [];
$workout_values = [];
while ($row = $workout_data->fetch_assoc()) {
    $workout_dates[] = $row['date'];
    $workout_values[] = $row['total_reps'];
}

$calorie_dates = [];
$calorie_intake = [];
$calorie_burn = [];
while ($row = $calorie_data->fetch_assoc()) {
    $calorie_dates[] = $row['date'];
    if ($row['type'] == 'intake') {
        $calorie_intake[] = $row['total_calories'];
    } else {
        $calorie_burn[] = $row['total_calories'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Fitness Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0d0d0d;
            color: #ff4d4d;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1a1a1a;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
        }
        h1 {
            margin: 0;
            color: #ff3333;
            font-size: 36px;
        }
        button {
            background: #ff1a1a;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 8px;
            margin: 15px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #e60000;
        }
        p {
            text-align: center;
            font-size: 20px;
            color: #fff;
        }
        canvas {
            display: block;
            margin: 30px auto;
            max-width: 90%;
            background: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 77, 77, 0.2);
        }
    </style>
    <script>
        async function connectToSmartwatch() {
            try {
                console.log("🔍 Searching for smartwatch...");
                const device = await navigator.bluetooth.requestDevice({
                    acceptAllDevices: true,
                    optionalServices: ['heart_rate']
                });

                console.log("✅ Smartwatch found: " + device.name);
                const server = await device.gatt.connect();
                console.log("✅ Connected to smartwatch!");
                checkHeartRateCharacteristics();
                const service = await server.getPrimaryService('heart_rate');
                const characteristic = await service.getCharacteristic('heart_rate_measurement');

                characteristic.addEventListener('characteristicvaluechanged', handleHeartRateData);
                await characteristic.startNotifications();
                alert("Smartwatch Connected!");

            } catch (error) {
                console.error("❌ Connection Failed:", error);
                alert("Failed to connect! Check Bluetooth & try again.");
            }
        }

        async function checkHeartRateCharacteristics() {
            try {
                const device = await navigator.bluetooth.requestDevice({
                    acceptAllDevices: true,
                    optionalServices: ['heart_rate']
                });
                const server = await device.gatt.connect();
                const service = await server.getPrimaryService('heart_rate');
                const characteristics = await service.getCharacteristics();
                console.log("✅ Available Heart Rate Characteristics:");
                characteristics.forEach(char => console.log(char.uuid));
            } catch (error) {
                console.error("❌ Error fetching heart rate characteristics:", error);
            }
        }

        function handleHeartRateData(event) {
            const value = event.target.value;
            const heartRate = value.getUint8(1);
            document.getElementById("heartRate").innerText = heartRate + " BPM";
            fetch("save_heart_rate.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "heart_rate=" + heartRate
            });
        }
    </script>
</head>
<body>
    <header>
        <h1>Fitness Dashboard</h1>
    </header>
    <div style="text-align:center;">
        <button onclick="connectToSmartwatch()">Connect Smartwatch</button>
        <button onclick="checkHeartRateCharacteristics()">Check Heart Rate Characteristics</button>
        <p>Heart Rate: <span id="heartRate">-- BPM</span></p>
    </div>
    <div>
        <canvas id="workoutChart"></canvas>
    </div>
    <div>
        <canvas id="calorieChart"></canvas>
    </div>
    <script>
        const workoutCtx = document.getElementById('workoutChart').getContext('2d');
        new Chart(workoutCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($workout_dates); ?>,
                datasets: [{
                    label: 'Total Reps',
                    data: <?php echo json_encode($workout_values); ?>,
                    borderColor: 'blue',
                    fill: false
                }]
            }
        });

        const calorieCtx = document.getElementById('calorieChart').getContext('2d');
        new Chart(calorieCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($calorie_dates); ?>,
                datasets: [
                    {
                        label: 'Calories Intake',
                        data: <?php echo json_encode($calorie_intake); ?>,
                        backgroundColor: 'green'
                    },
                    {
                        label: 'Calories Burned',
                        data: <?php echo json_encode($calorie_burn); ?>,
                        backgroundColor: 'red'
                    }
                ]
            }
        });
    </script>
</body>
</html>

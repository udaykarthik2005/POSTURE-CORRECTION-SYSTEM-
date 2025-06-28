<?php
session_start();
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heartRate = $_POST["heart_rate"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO health_data (user_id, heart_rate) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $heartRate);
    $stmt->execute();
    $stmt->close();
}
?>

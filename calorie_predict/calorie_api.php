<?php
$data = file_get_contents("php://input");
$response = shell_exec("echo " . escapeshellarg($data) . " | python3 calorie_predict.py");
echo $response;
?>

<?php
header("Content-Type: application/json");

// Get input data
$data = json_decode(file_get_contents("php://input"), true);
$userQuery = isset($data["query"]) ? trim($data["query"]) : "";

// Validate input
if (empty($userQuery)) {
    echo json_encode(["response" => "Please ask a question related to fitness and well-being."]);
    exit();
}

// OpenAI API Configuration
$apiKey = "sk-proj-REPLACE_WITH_YOUR_KEY"; // Replace with your actual API key
$apiUrl = "https://api.openai.com/v1/chat/completions";

$requestData = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "system", "content" => "You are a helpful chatbot specializing in fitness, health, and well-being. Answer questions with accurate and concise fitness advice."],
        ["role" => "user", "content" => $userQuery]
    ],
    "temperature" => 0.7
];

// Initialize cURL
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle API response
if ($http_code !== 200) {
    echo json_encode(["response" => "Error connecting to AI service."]);
    exit();
}

$chatbotResponse = json_decode($response, true);

// Extract and return chatbot's reply
$reply = $chatbotResponse['choices'][0]['message']['content'] ?? "I couldn't understand your question. Please ask again.";
echo json_encode(["response" => nl2br($reply)]);
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chatbot</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d0d;
            color: #ff4d4d;
            text-align: center;
        }
        .chat-container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background: #1a1a1a;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(255, 0, 0, 0.3);
            border-radius: 8px;
        }
        .chat-box {
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ff3333;
            padding: 10px;
            background: #0d0d0d;
            color: #fff;
            margin-bottom: 15px;
        }
        .user-message {
            text-align: right;
            color: #ff4d4d;
            margin: 10px 0;
        }
        .bot-message {
            text-align: left;
            color: #66ff66;
            margin: 10px 0;
        }
        input, button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
        }
        input {
            background: #333;
            color: #fff;
            margin-bottom: 10px;
        }
        button {
            background: #ff1a1a;
            color: white;
            font-weight: bold;
        }
        button:hover {
            background: #e60000;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h2>AI Chatbot 🤖</h2>
    <div class="chat-box" id="chatBox"></div>

    <input type="text" id="userInput" placeholder="Ask anything about fitness, diet, workouts...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
    const chatBox = document.getElementById('chatBox');

    function sendMessage() {
        const input = document.getElementById('userInput');
        const userText = input.value.trim();
        if (!userText) return;

        appendMessage('user', userText);
        input.value = '';

        const response = getBotResponse(userText);
        setTimeout(() => appendMessage('bot', response), 500);
    }

    function appendMessage(sender, text) {
        const msg = document.createElement('div');
        msg.className = sender === 'user' ? 'user-message' : 'bot-message';
        msg.textContent = text;
        chatBox.appendChild(msg);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function getBotResponse(message) {
        const msg = message.toLowerCase();

        if (msg.includes("diet")) {
            return "Your diet should include a balance of proteins, carbs, and fats. Need a vegetarian or high-protein plan?";
        } else if (msg.includes("workout") || msg.includes("exercise")) {
            return "A good workout routine includes strength, cardio, and flexibility. Want help planning your schedule?";
        } else if (msg.includes("calorie")) {
            return "To lose weight, stay in a calorie deficit. I can help estimate your daily needs.";
        } else if (msg.includes("protein")) {
            return "Protein is essential for muscle recovery. Great sources include eggs, chicken, tofu, and lentils.";
        } else if (msg.includes("hydration") || msg.includes("water")) {
            return "Staying hydrated is key! Aim for 2-3 liters of water a day.";
        } else if (msg.includes("sleep")) {
            return "Sleep helps muscle repair and mental health. Aim for 7-9 hours daily.";
        } else if (msg.includes("hi") || msg.includes("hello")) {
            return "Hi there! Ask me anything about fitness or diet!";
        } else {
            return "I'm here to help with anything fitness or diet related. Try asking about diet, workouts, or calories!";
        }
    }
</script>

</body>
</html>

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("userInput").addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });
});

function sendMessage() {
    let userInput = document.getElementById("userInput").value.trim();
    if (userInput === "") return;

    let chatBox = document.getElementById("chatBox");
    
    // Display user message
    let userMessage = `<p class="user-message">You: ${userInput}</p>`;
    chatBox.innerHTML += userMessage;
    
    document.getElementById("userInput").value = "";

    // Send request to backend
    fetch("../pages/chatbot_backend.php", {
        method: "POST",
        body: JSON.stringify({ query: userInput }),
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.json())
    .then(data => {
        let botMessage = `<p class="bot-message">Bot: ${data.response}</p>`;
        chatBox.innerHTML += botMessage;
        chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

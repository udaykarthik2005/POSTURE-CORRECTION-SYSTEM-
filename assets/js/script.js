document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("dark-mode-toggle");
    const body = document.body;

    // Check for saved dark mode preference
    if (localStorage.getItem("dark-mode") === "enabled") {
        body.classList.add("dark-mode");
        darkModeToggle.innerText = "☀️"; // Change button icon to sun
    }

    darkModeToggle.addEventListener("click", function () {
        if (body.classList.contains("dark-mode")) {
            body.classList.remove("dark-mode");
            localStorage.setItem("dark-mode", "disabled");
            darkModeToggle.innerText = "🌙"; // Change back to moon
        } else {
            body.classList.add("dark-mode");
            localStorage.setItem("dark-mode", "enabled");
            darkModeToggle.innerText = "☀️"; // Change to sun
        }
    });

    // Live Date & Time
    function updateDateTime() {
        const now = new Date();
        document.getElementById("datetime").innerText = now.toLocaleString();
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();
});

function captureAndSend() {
    const video = document.querySelector('video');
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);
    const base64Image = canvas.toDataURL('image/jpeg').split(',')[1];

    fetch('api/calorie_api.php', {
        method: 'POST',
        body: base64Image
    })
    .then(res => res.json())
    .then(data => {
        if (data.calories) {
            document.getElementById("calorieDisplay").innerText = `Calories: ${data.calories} kcal`;
        } else {
            document.getElementById("calorieDisplay").innerText = "No pose detected";
        }
    });
}

// Call this function at intervals (e.g., every 3s)
setInterval(captureAndSend, 3000);

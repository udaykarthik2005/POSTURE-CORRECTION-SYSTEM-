<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/holistic"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <style>
        /* Style for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #workout-name {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        #video {
            margin-top: 20px;
            width: 80%;
            height: auto;
        }

        #start-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #start-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Workout Calorie Tracker</h1>

<!-- Display the selected workout type -->
<p id="workout-name"></p>

<!-- Video element for webcam -->
<video id="video" autoplay></video>

<!-- Start button to initiate webcam and tracking -->
<button id="start-button">Start Tracking</button>

<script>
    // Extract the workout type from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const workout = urlParams.get('workout');

    // Display the selected workout type
    document.getElementById('workout-name').textContent = `You are doing: ${workout}`;

    // Setup webcam for tracking
    const videoElement = document.getElementById('video');
    const startButton = document.getElementById('start-button');

    async function setupWebcam() {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: true
        });
        videoElement.srcObject = stream;
    }

    // Start tracking when the button is clicked
    startButton.addEventListener('click', () => {
        setupWebcam();
        startButton.disabled = true;
        startButton.textContent = 'Tracking...';
    });

    // Mediapipe Pose Estimation setup
    const holistic = new window.mediapipe.holistic.Holistic({
        locateFile: (file) => {
            return `https://cdn.jsdelivr.net/npm/@mediapipe/holistic/${file}`;
        }
    });

    holistic.onResults((results) => {
        // You can add pose detection logic here
        if (results.poseLandmarks) {
            console.log(results.poseLandmarks);
            // Example: Checking if the person's posture is straight
            if (isPostureCorrect(results.poseLandmarks)) {
                alert('Posture Correct!');
            } else {
                alert('Please correct your posture!');
            }
        }
    });

    // Define function to check posture (basic example)
    function isPostureCorrect(landmarks) {
        // Example logic for posture check
        const nose = landmarks[0]; // Just an example
        const shoulderLeft = landmarks[11];
        const shoulderRight = landmarks[12];

        // Check if shoulders are aligned with the nose
        if (Math.abs(shoulderLeft.y - shoulderRight.y) < 0.05) {
            return true;
        } else {
            return false;
        }
    }

    // Start tracking once webcam is set up
    async function startPoseTracking() {
        const camera = new window.Camera(videoElement, {
            onFrame: async () => {
                await holistic.send({ image: videoElement });
            },
            width: 640,
            height: 480
        });
        camera.start();
    }
</script>

</body>
</html>

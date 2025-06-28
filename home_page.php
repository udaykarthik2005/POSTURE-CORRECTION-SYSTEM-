<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AI Fitness Trainer</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      cursor: none;
    }

    body {
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      background: linear-gradient(145deg, #000000, #1a1a1a);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
      color: #fff;
    }

    header {
      position: absolute;
      top: 20px;
      text-align: center;
      font-size: 1.5em;
      color: #ff3c3c;
      text-shadow: 2px 2px 8px #000;
    }

    h1 {
      font-size: 3em;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #ff3c3c;
      animation: slideIn 1s ease-in-out;
    }

    @keyframes slideIn {
      0% { transform: translateY(-100px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    .login-button {
      margin-top: 30px;
      padding: 15px 40px;
      font-size: 1.2em;
      background: transparent;
      border: 2px solid #ff3c3c;
      color: #ff3c3c;
      border-radius: 30px;
      transition: 0.3s;
      position: relative;
      overflow: hidden;
    }

    .login-button:hover {
      background: #ff3c3c;
      color: #fff;
      box-shadow: 0 0 15px #ff3c3c;
    }

    .datetime {
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 1em;
      color: #f0f0f0;
      text-shadow: 1px 1px 3px #000;
    }

    /* Glowing Particle Effect */
    .particles {
      position: absolute;
      width: 100%;
      height: 100%;
      background: transparent;
      overflow: hidden;
      z-index: -1;
    }

    .particle {
      position: absolute;
      width: 5px;
      height: 5px;
      background: #ff3c3c;
      border-radius: 50%;
      animation: floatParticles 6s linear infinite;
    }

    @keyframes floatParticles {
      from {
        transform: translateY(100vh);
        opacity: 1;
      }
      to {
        transform: translateY(-100vh);
        opacity: 0;
      }
    }

    /* Custom Cursor */
    .cursor {
      position: fixed;
      top: 0;
      left: 0;
      width: 15px;
      height: 15px;
      background: #ff3c3c;
      border-radius: 50%;
      pointer-events: none;
      z-index: 10000;
      transform: translate(-50%, -50%);
      transition: transform 0.05s ease;
    }

  </style>
</head>
<body>

  <div class="datetime">
    <span id="current-date"></span> | <span id="current-time"></span>
  </div>

  <header id="dateDisplay"></header>
  <h1>Start Your Journey Today</h1>
  <button class="login-button" onclick="location.href='pages/login.php'">Let's Go!</button>

  <!-- Cursor -->
  <div class="cursor" id="cursor"></div>

  <!-- Particles -->
  <div class="particles" id="particles"></div>

  <script>
    // Date and time
    function updateDateTime() {
      const now = new Date();
      const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

      document.getElementById('dateDisplay').textContent = now.toLocaleDateString(undefined, dateOptions);
      document.getElementById('current-date').textContent = now.toLocaleDateString();
      document.getElementById('current-time').textContent = now.toLocaleTimeString();
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();

    // Custom cursor effect
    const cursor = document.getElementById('cursor');
    document.addEventListener('mousemove', (e) => {
      cursor.style.top = e.clientY + 'px';
      cursor.style.left = e.clientX + 'px';
    });

    // Glowing particles
    const particleContainer = document.getElementById('particles');
    for (let i = 0; i < 50; i++) {
      const p = document.createElement('div');
      p.classList.add('particle');
      p.style.left = `${Math.random() * 100}%`;
      p.style.animationDuration = `${Math.random() * 5 + 3}s`;
      p.style.opacity = Math.random();
      particleContainer.appendChild(p);
    }
  </script>
</body>
</html>

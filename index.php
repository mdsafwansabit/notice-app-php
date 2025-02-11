<?php
include "db.php";

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollreveal/4.0.9/scrollreveal.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            transition: background 0.3s ease-in-out;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #121212;
            color: #fff;
        }

        .container {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 20px;
            margin: 40px 0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease-in-out;
        }

        .dark-mode .container {
            background: rgba(40, 40, 40, 0.85);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
        }

        .dark-mode h1 {
            color: #fff;
        }

        /* Post Styles */
        .post {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 20px 0;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .post:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .post {
            background: rgba(50, 50, 50, 0.85);
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            transition: color 0.3s ease-in-out;
        }

        .dark-mode .title {
            color: #ffcc00;
        }

        .content {
            margin-top: 10px;
            color: #555;
        }

        .dark-mode .content {
            color: #ddd;
        }

        small {
            display: block;
            margin-top: 10px;
            font-size: 12px;
            color: #888;
        }

        .dark-mode small {
            color: #bbb;
        }

        /* Dark Mode Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .dark-mode .toggle-btn {
            background: #ffcc00;
            color: black;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .toggle-btn {
                top: 15px;
                right: 15px;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-btn" onclick="toggleDarkMode()">🌙 Dark Mode</button>
    <div class="container">
        <h1>Notices</h1>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <div class="title"><?php echo $row['title']; ?></div>
                <div class="content"><?php echo nl2br($row['content']); ?></div>
                <small>Published on: <?php echo date("F j, Y", strtotime($row['created_at'])); ?></small>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("darkMode", document.body.classList.contains("dark-mode") ? "enabled" : "disabled");
        }

        // Remember Dark Mode
        if (localStorage.getItem("darkMode") === "enabled") {
            document.body.classList.add("dark-mode");
        }

        // Scroll Reveal Animations
        ScrollReveal().reveal('.post', {
            delay: 200,
            duration: 800,
            distance: '50px',
            origin: 'bottom',
            easing: 'ease-in-out'
        });

        ScrollReveal().reveal('h1', {
            delay: 100,
            duration: 800,
            distance: '30px',
            origin: 'top'
        });
    </script>
</body>
</html>

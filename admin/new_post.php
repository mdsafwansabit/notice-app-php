<?php
session_start();
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        $message = "New post created successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Post</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .post-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }
        .post-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .post-container input, .post-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .post-container textarea {
            height: 150px;
            resize: none;
        }
        .post-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #ff7e5f;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 20px;
        }
        .post-container button:hover {
            background: #e06650;
        }
        .message {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="post-container">
        <h2>Create New Post</h2>
        <?php 
        if (isset($message)) echo "<p class='message'>$message</p>";
        if (isset($error)) echo "<p class='error'>$error</p>"; 
        ?>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit">Publish</button>
            
        </form>
        <a href="dashboard.php"><button>Back to dashboard</button></a>
    </div>
</body>
</html>

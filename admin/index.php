<?php
session_start();
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user data
    $user = $result->fetch_assoc();

    if ($user) { // If a user is found, allow login
        $_SESSION["admin"] = $user["username"]; // Store session
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #667eea;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 20px;
        }
        .login-button:hover {
            background: #564b93;
        }
        .error {
            color: red;
            margin-top: 10px;
        }

        .button {
    display: inline-block;
    cursor: pointer;
    padding: 12px 20px;
    background: linear-gradient(135deg, #6b73ff, #000dff);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    flex: 1;
}

.button:hover {
    background: linear-gradient(135deg, #000dff, #6b73ff);
    transform: scale(1.05);
}

.button:active {
    transform: scale(0.95);
}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-button">Login</button>
        </form>
        <a href="/"><button class="button">Back to home</button></a>
    </div>
</body>
</html>

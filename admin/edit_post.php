<?php
session_start();
include "../db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating post: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Edit Post</h2>
        <form method="POST" class="form">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required><?php echo $post['content']; ?></textarea>

            <button type="submit" class="btn">Update Post</button>
            
        </form>
        <a href="dashboard.php"><button class="button">Back to dashboard</button></a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".card").style.opacity = "0";
    setTimeout(() => {
        document.querySelector(".card").style.opacity = "1";
        document.querySelector(".card").style.transform = "scale(1)";
        document.querySelector(".card").style.transition = "0.5s ease-out";
    }, 200);
});
</script>

</body>
</html>

<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Container */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

/* Card */
.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    width: 400px;
    text-align: center;
    opacity: 0;
    transform: scale(0.9);
}

/* Form */
.form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-weight: bold;
    text-align: left;
    display: block;
}

/* Inputs */
input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #667eea;
    box-shadow: 0 0 5px rgba(102, 126, 234, 0.5);
}

/* Button */
.btn {
    background: #667eea;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    margin-bottom: 20px;
}

.btn:hover {
    background: #764ba2;
}
.button {
    display: inline-block;
    padding: 12px 24px;
    background: linear-gradient(135deg, #6b73ff, #000dff);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.button:hover {
    background: linear-gradient(135deg, #000dff, #6b73ff);
    transform: scale(1.05);
}

.button:active {
    transform: scale(0.95);
}


</style>
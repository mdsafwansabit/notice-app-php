<?php
session_start();
include "../db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

$loggedInUser = $_SESSION["admin"]; // Get logged-in admin username

// Fetch all posts
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <div class="user-info">
            <span>👤 Logged in as: <strong><?php echo $loggedInUser; ?></strong></span>
        </div>
    </header>

    <div class="button-container">
        <a href="/" class="btn">🏠 Home</a>
        <a href="new_post.php" class="btn">➕ Add New Post</a>
        <a href="logout.php" class="btn logout">🚪 Logout</a>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td>
                    <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="edit-btn">✏ Edit</a>
                    <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this post?');">🗑 Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        // Smooth table row fade-in effect
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("tr").forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = "1";
                    row.style.transform = "translateY(0)";
                    row.style.transition = "0.5s ease-out";
                }, index * 100);
            });

            // Animate user info
            let userInfo = document.querySelector(".user-info");
            userInfo.style.opacity = "0";
            userInfo.style.transform = "translateY(-10px)";
            setTimeout(() => {
                userInfo.style.opacity = "1";
                userInfo.style.transform = "translateY(0)";
                userInfo.style.transition = "0.5s ease-out";
            }, 500);
        });
    </script>

</body>
</html>

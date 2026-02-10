<?php
session_start();

// Admin login check
if (!isset($_SESSION['admin_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Correct DB file path
require_once __DIR__ . '/../inc/db.php';

$message = "";

// Form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title      = mysqli_real_escape_string($conn, $_POST['title']);
    $content    = mysqli_real_escape_string($conn, $_POST['content']);
    $category   = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "INSERT INTO news (title, content, category_id) 
              VALUES ('$title', '$content', '$category')";

    if (mysqli_query($conn, $query)) {
        $message = "✅ News added successfully!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add News</title>
</head>
<body>

    <h2>Add News Article</h2>

    <p style="color:green;"><?= $message ?></p>

    <form method="POST">

        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="6" required></textarea><br><br>

        <label>Category ID:</label><br>
        <input type="number" name="category" required><br><br>

        <button type="submit">Add News</button>
    </form>

</body>
</html>

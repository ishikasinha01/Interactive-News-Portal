<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    position: fixed;
    color: #fff;
}

.sidebar h2 {
    text-align: center;
    padding: 20px;
    background: #1a252f;
    margin: 0;
}

.sidebar a {
    display: block;
    padding: 15px 20px;
    color: #fff;
    text-decoration: none;
    border-bottom: 1px solid #3e556b;
}

.sidebar a:hover {
    background: #34495e;
}

/* Main */
.main {
    margin-left: 220px;
    padding: 20px;
}

/* Header */
.header {
    background: #fff;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Cards */
.cards {
    display: flex;
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    flex: 1;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.card h3 {
    margin: 0;
    color: #333;
}

.card p {
    font-size: 22px;
    color: #2980b9;
    margin-top: 10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add_news.php">Add News</a>
    <a href="manage_news.php">Manage News</a>
    <a href="categories.php">Categories</a>
    <a href="auth/logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="main">

    <div class="header">
        <h2>Welcome, <?php echo $_SESSION['admin_name']; ?> 👋</h2>
        <p>Interactive News Portal – Admin Dashboard</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total News</h3>
            <p>12</p>
        </div>

        <div class="card">
            <h3>Categories</h3>
            <p>5</p>
        </div>

        <div class="card">
            <h3>Users</h3>
            <p>20</p>
        </div>
    </div>

</div>

</body>
</html>

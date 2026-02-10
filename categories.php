<?php
session_start();

// check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: auth/login.php");
    exit();
}

// database connection
include('../inc/db.php');

// add category
if (isset($_POST['add_category'])) {
    $category_name = trim($_POST['category_name']);

    if (!empty($category_name)) {
        $query = "INSERT INTO categories (name) VALUES ('$category_name')";
        mysqli_query($conn, $query);
    }
}

// fetch categories
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
        }
        input[type=text] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
        }
        button {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📂 Manage Categories</h2>

    <form method="post">
        <input type="text" name="category_name" placeholder="Enter category name" required>
        <button type="submit" name="add_category">Add</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No categories found</td></tr>";
        }
        ?>
    </table>

    <p style="text-align:center; margin-top:15px;">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </p>
</div>

</body>
</html>

<?php include("../inc/header.php"); ?>
<?php include("../inc/db.php"); ?>

<h2>Add New Category</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Category added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: Could not add category.</p>";
    }
}
?>

<form method="POST">
    <label>Category Name:</label>
    <input type="text" name="name" required>
    <button type="submit">Add Category</button>
</form>

<?php include("../inc/footer.php"); ?>

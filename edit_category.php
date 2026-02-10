<?php include("../inc/header.php"); ?>
<?php include("../inc/db.php"); ?>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Category ID");
}

$id = intval($_GET['id']);

$stmt = $mysqli->prepare("SELECT name FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Category not found");
}

$row = $result->fetch_assoc();
?>

<h2>Edit Category</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $update = $mysqli->prepare("UPDATE categories SET name=? WHERE id=?");
    $update->bind_param("si", $name, $id);

    if ($update->execute()) {
        echo "<p style='color:green;'>Category Updated Successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating category.</p>";
    }
}
?>

<form method="POST">
    <label>Category Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <button type="submit">Update</button>
</form>

<?php include("../inc/footer.php"); ?>

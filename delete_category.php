<?php
include("../inc/db.php");

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = intval($_GET['id']);

$stmt = $mysqli->prepare("DELETE FROM categories WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: manage_category.php");
} else {
    echo "Error deleting category.";
}
?>

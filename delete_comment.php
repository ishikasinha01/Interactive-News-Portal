<?php
include "../inc/db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request! Comment ID missing.");
}

$comment_id = intval($_GET['id']);

$sql = "DELETE FROM comments WHERE id = $comment_id";
$delete = mysqli_query($conn, $sql);

if ($delete) {
    header("Location: manage_comments.php?msg=deleted");
    exit;
} else {
    die("Failed to delete comment!");
}
?>

<?php
require_once("../inc/db.php");

$id = intval($_GET['id']);

$stmt = $mysqli->prepare("DELETE FROM comments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: manage_comments.php");
exit;
?>

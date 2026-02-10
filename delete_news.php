<?php
include("../inc/db.php");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM news WHERE id=$id");

header("Location: manage_news.php");
?>

<?php
session_start();
include "../inc/db.php";
include "../inc/functions.php";

$id = intval($_GET['id']);

// View counter
$conn->query("UPDATE articles SET views = views + 1 WHERE id=$id");

$article = $conn->query("SELECT * FROM articles WHERE id=$id")->fetch_assoc();
?>
<h1><?= $article['title'] ?></h1>
<img src="../uploads/article_images/<?= $article['image'] ?>" width="50%">
<p><?= nl2br($article['content']) ?></p>
<p>Views: <?= $article['views'] ?></p>
<a href="../comments/add_comment.php?id=<?= $id ?>">Add Comment</a>

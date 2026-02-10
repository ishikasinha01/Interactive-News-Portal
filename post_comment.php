<?php
include("inc/db.php");

$article_id = $_POST['article_id'];
$user_name  = $_POST['user_name'];
$comment    = $_POST['comment'];

$conn->query("INSERT INTO comments(article_id,user_name,comment) VALUES('$article_id','$user_name','$comment')");

header("Location: article.php?id=$article_id");
exit;
?>

<?php
require_once("inc/db.php");
require_once("inc/functions.php");
session_start();

if (!isset($_POST['csrf']) || !check_csrf($_POST['csrf'])) {
    die("Security Error.");
}

$article_id = intval($_POST['article_id']);
$user_id = $_SESSION['user_id'] ?? 0;
$comment = trim($_POST['comment']);

if ($user_id == 0) {
    die("Login required to comment!");
}

if (!can_post_comment($article_id)) {
    die("You are commenting too fast. Wait a few seconds.");
}

$stmt = $mysqli->prepare("INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $article_id, $user_id, $comment);
$stmt->execute();

header("Location: article.php?id=".$article_id);
exit;
?>

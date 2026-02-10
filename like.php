<?php
include "inc/db.php";

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$article_id = intval($_GET['id']);
$user_ip = $_SERVER['REMOTE_ADDR'];

// CHECK if already liked
$sql = "SELECT id FROM likes WHERE news_id=? AND user_ip=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $article_id, $user_ip);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    $insert = $conn->prepare("
        INSERT INTO likes (news_id, user_ip)
        VALUES (?, ?)
    ");
    $insert->bind_param("is", $article_id, $user_ip);
    $insert->execute();
}

header("Location: article.php?id=$article_id");
exit;
?>

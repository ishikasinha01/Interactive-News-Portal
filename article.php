<?php
include "inc/db.php";
include "inc/header.php";

if (!isset($_GET['id'])) {
    die("Invalid Article ID");
}

$article_id = intval($_GET['id']);

// GET USER IP
$user_ip = $_SERVER['REMOTE_ADDR'];

// INSERT VIEW INTO engagements IF NOT EXISTS
$view_sql = "SELECT id FROM engagements 
             WHERE article_id=? AND user_ip=? AND type='view'";

$stmt = $conn->prepare($view_sql);
$stmt->bind_param("is", $article_id, $user_ip);
$stmt->execute();
$check = $stmt->get_result();

if ($check->num_rows == 0) {

    $insert = $conn->prepare("
        INSERT INTO engagements(article_id, user_ip, type)
        VALUES (?, ?, 'view')
    ");
    $insert->bind_param("is", $article_id, $user_ip);
    $insert->execute();
}

// FETCH ARTICLE
$art = $conn->prepare("SELECT * FROM news WHERE id=?");
$art->bind_param("i", $article_id);
$art->execute();
$article = $art->get_result()->fetch_assoc();

if (!$article) {
    die("Article not found!");
}

?>

<h2><?php echo $article['title']; ?></h2>
<p><?php echo nl2br($article['content']); ?></p>

<a href="like.php?id=<?php echo $article_id; ?>" class="btn btn-success">👍 Like</a>

<?php include "inc/footer.php"; ?>

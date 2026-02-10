<?php
include "inc/db.php";
include "inc/header.php";

$sql = "
SELECT n.id, n.title, n.image, n.created_at,

       -- TOTAL COMMENTS
       (SELECT COUNT(*) FROM comments c WHERE c.article_id = n.id) AS comment_count,

       -- TOTAL LIKES
       (SELECT COUNT(*) FROM likes l WHERE l.news_id = n.id) AS like_count,

       -- TOTAL VIEWS
       (SELECT COUNT(*) FROM engagements e WHERE e.article_id = n.id AND e.type='view') AS view_count

FROM news n
ORDER BY (comment_count + like_count + view_count) DESC
LIMIT 10
";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2>🔥 Trending News</h2><hr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card mb-3 p-3">
        <h3><?php echo $row['title']; ?></h3>
        <p>
            👁 Views: <?php echo $row['view_count']; ?> |
            👍 Likes: <?php echo $row['like_count']; ?> |
            💬 Comments: <?php echo $row['comment_count']; ?>
        </p>
        <a href="article.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
    </div>

<?php } ?>

</div>

<?php include "inc/footer.php"; ?>

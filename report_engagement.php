<?php
include "../inc/db.php";
include "../inc/header.php";
?>

<div class="container mt-4">
    <h2>⭐ Engagement Report (Views, Likes, Comments)</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>News Title</th>
                <th>Total Views</th>
                <th>Total Likes</th>
                <th>Total Comments</th>
                <th>Published On</th>
            </tr>
        </thead>

        <tbody>
        <?php
        
        $sql = "
            SELECT 
                n.id,
                n.title,
                n.created_at,

                -- VIEWS (engagements table uses article_id)
                (SELECT COUNT(*) FROM engagements e WHERE e.article_id = n.id) AS total_views,

                -- LIKES (likes table uses news_id)
                (SELECT COUNT(*) FROM likes l WHERE l.news_id = n.id) AS total_likes,

                -- COMMENTS (comments table uses article_id)
                (SELECT COUNT(*) FROM comments c WHERE c.article_id = n.id) AS total_comments

            FROM news n
            ORDER BY total_views DESC
        ";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['total_views'] . "</td>";
            echo "<td>" . $row['total_likes'] . "</td>";
            echo "<td>" . $row['total_comments'] . "</td>";
            echo "<td>" . date("d M Y", strtotime($row['created_at'])) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</div>

<?php include "../inc/footer.php"; ?>

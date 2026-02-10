<?php 
include "../inc/db.php";
include "../inc/header.php";  // FIXED

$sql = "SELECT c.id, c.comment, c.created_at, 
               n.title AS news_title
        FROM comments c
        LEFT JOIN news n ON n.id = c.article_id
        ORDER BY c.id DESC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2>Manage Comments</h2>
    <hr>

    <table border="1" width="100%" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>News Title</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['news_title']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="delete_comment.php?id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Delete this comment?');"
                       style="color:red;">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include "../inc/footer.php"; ?>  <!-- FIXED -->

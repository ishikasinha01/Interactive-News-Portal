<?php
// DB CONNECTION
include("../inc/db.php");

// HEADER
include("../inc/header.php");
?>

<h2 style="text-align:center; padding:10px; background:#007bff; color:white;">Manage News</h2>

<table border="1" width="100%" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Posted On</th>
        <th>Action</th>
    </tr>

<?php
// FETCH NEWS + CATEGORY
$sql = "
SELECT news.id, news.title, news.created_at, 
       categories.name AS category 
FROM news 
LEFT JOIN categories ON news.category_id = categories.id 
ORDER BY news.id DESC
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $category = $row['category'] ? $row['category'] : "No Category";

    echo "
    <tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$category}</td>
        <td>" . date('d M Y', strtotime($row['created_at'])) . "</td>
        <td>
            <a href='edit_news.php?id={$row['id']}'>Edit</a> |
            <a href='delete_news.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>
    ";
}
?>
</table>

<?php
// FOOTER
include("../inc/footer.php");
?>

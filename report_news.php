<?php 
include("../inc/db.php");
include("../inc/header.php");
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">📄 All News Report</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT news.*, categories.name AS category_name 
                    FROM news 
                    LEFT JOIN categories ON news.category_id = categories.id
                    ORDER BY news.id DESC";

            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>" . ($row['category_name'] ?? 'No Category') . "</td>
                        <td>" . date("d M Y", strtotime($row['created_at'])) . "</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../inc/footer.php"); ?>

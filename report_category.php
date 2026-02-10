<?php
include "../inc/db.php";
include "../inc/header.php";  // FIXED
?>

<div class="container mt-4">
    <h2>📊 Category Wise News Report</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Category</th>
            <th>Total News</th>
        </tr>

        <?php
        // Category-wise count
        $sql = "
            SELECT c.name AS category_name, 
                   COUNT(n.id) AS total_news
            FROM categories c
            LEFT JOIN news n ON c.id = n.category_id
            GROUP BY c.id
            ORDER BY c.name ASC
        ";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['category_name'] . "</td>";
            echo "<td>" . $row['total_news'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</div>

<?php include "../inc/footer.php"; ?> <!-- FIXED -->

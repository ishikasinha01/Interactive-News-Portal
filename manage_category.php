<?php
include "../inc/db.php";
include "../inc/header.php";   // FIXED
?>

<div class="container mt-4">
    <h2>Manage Categories</h2>
    <a href="add_category.php" class="btn btn-primary mb-3">+ Add Category</a>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>
                    <a href='edit_category.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='delete_category.php?id=".$row['id']."' class='btn btn-sm btn-danger'
                       onclick='return confirm(\"Delete this category?\")'>
                       Delete
                    </a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php include "../inc/footer.php"; ?>   <!-- FIXED -->

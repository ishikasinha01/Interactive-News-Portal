<?php
include("inc/db.php");
include("inc/header.php");

// Check if search parameter exists
if (!isset($_GET['q']) || trim($_GET['q']) === "") {
    echo "<div class='alert alert-warning text-center mt-4'>No search term provided.</div>";
    include("inc/footer.php");
    exit;
}

$search = "%" . trim($_GET['q']) . "%";

// Run query
$stmt = $conn->prepare("
    SELECT id, title, content, image, created_at
    FROM news
    WHERE title LIKE ? OR content LIKE ?
");

$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h3>Search Results</h3>
    <div class="row">

    <?php while ($row = $result->fetch_assoc()): ?>

        <div class="col-md-4 mb-3">
            <div class="card">
                <?php if (!empty($row['image'])): ?>
                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top">
                <?php endif; ?>

                <div class="card-body">
                    <h5><?php echo $row['title']; ?></h5>
                    <p><?php echo substr($row['content'], 0, 100) . "..."; ?></p>
                    <a href="view_news.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

    </div>
</div>

<?php include("inc/footer.php"); ?>

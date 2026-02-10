<?php
include("inc/db.php");
include("inc/header.php");

// Check if search keyword is provided
if (!isset($_GET['keyword']) || trim($_GET['keyword']) === "") {
    echo "<div class='alert alert-warning text-center mt-4'>Please enter a search keyword.</div>";
    include("inc/footer.php");
    exit;
}

$keyword = "%" . trim($_GET['keyword']) . "%";

// ONLY title & content exist → so search only these
$sql = "SELECT * FROM news 
        WHERE title LIKE ? 
        OR content LIKE ?
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $keyword, $keyword);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h2>Search Results</h2>
    <hr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>

            <div class="card mb-4">
                <?php if (!empty($row['image'])) { ?>
                    <img src="uploads/<?php echo $row['image']; ?>" 
                         class="card-img-top" 
                         style="max-height:250px; object-fit:cover;">
                <?php } ?>

                <div class="card-body">
                    <h3 class="card-title"><?php echo $row['title']; ?></h3>
                    <p class="card-text">
                        <?php echo substr($row['content'], 0, 150); ?>...
                    </p>
                    <a href="view_news.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<div class='alert alert-info mt-4 text-center'>No news found matching your search.</div>";
    }
    ?>

</div>

<?php 
include("inc/footer.php");
?>

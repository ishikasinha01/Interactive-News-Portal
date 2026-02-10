<?php
include("inc/db.php");
include("inc/header.php");

// Fix 1: ID check
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger text-center mt-4'>Invalid Category!</div>";
    include("inc/footer.php");
    exit;
}

$cat_id = intval($_GET['id']);

// Fix 2: Check if category exists
$cat_sql = "SELECT * FROM categories WHERE id = ?";
$stmt = $conn->prepare($cat_sql);
$stmt->bind_param("i", $cat_id);
$stmt->execute();
$cat_result = $stmt->get_result();

if ($cat_result->num_rows === 0) {
    echo "<div class='alert alert-danger text-center mt-4'>Category Not Found!</div>";
    include("inc/footer.php");
    exit;
}

$category = $cat_result->fetch_assoc();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4"><?php echo $category['name']; ?></h2>

<?php
// Fetch category-wise news
$news_sql = "SELECT * FROM news WHERE category_id = ?";
$stmt2 = $conn->prepare($news_sql);
$stmt2->bind_param("i", $cat_id);
$stmt2->execute();
$news_result = $stmt2->get_result();

if ($news_result->num_rows == 0) {
    echo "<p class='text-center text-muted'>No news found in this category.</p>";
} else {
    echo "<div class='row'>";
    while ($row = $news_result->fetch_assoc()) {
        echo "
        <div class='col-md-4 mb-3'>
            <div class='card'>
                <img src='uploads/{$row['image']}' class='card-img-top' alt=''>
                <div class='card-body'>
                    <h5 class='card-title'>{$row['title']}</h5>
                    <a href='view_news.php?id={$row['id']}' class='btn btn-primary btn-sm'>Read More</a>
                </div>
            </div>
        </div>";
    }
    echo "</div>";
}
?>

</div>

<?php include("inc/footer.php"); ?>

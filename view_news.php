<?php
include "inc/db.php";
include "inc/header.php";

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid news ID!</div>";
    include "inc/footer.php";
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<div class='alert alert-danger'>News not found!</div>";
    include "inc/footer.php";
    exit;
}

$news = $result->fetch_assoc();
?>

<div class="container mt-4">
    <h2><?php echo $news['title']; ?></h2>
    <p><small>Posted on <?php echo $news['created_at']; ?></small></p>

    <?php if (!empty($news['image'])) { ?>
        <img src="uploads/<?php echo $news['image']; ?>" class="img-fluid mb-3">
    <?php } ?>

    <p><?php echo nl2br($news['content']); ?></p>
</div>

<?php include "inc/footer.php"; ?>

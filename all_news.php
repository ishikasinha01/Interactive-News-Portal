<?php
include("inc/db.php");
include("inc/header.php");
?>

<style>
.news-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: 0.3s;
}
.news-card:hover {
    transform: translateY(-4px);
}
.news-title {
    font-size: 20px;
    font-weight: bold;
}
</style>

<div class="container mt-4">

    <h2 class="mb-4">All News</h2>

    <div class="row">

        <?php
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($n = $result->fetch_assoc()) {
                echo "
                <div class='col-md-3 mb-4'>
                    <div class='news-card'>
                        <a href='view_news.php?id=".$n['id']."' style='text-decoration:none;color:black;'>
                            <img src='uploads/".$n['image']."' class='img-fluid'>
                            <div class='p-3'>
                                <div class='news-title'>".$n['title']."</div>
                                <small class='text-muted'>".$n['created_at']."</small>
                            </div>
                        </a>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<div class='alert alert-warning'>No news found!</div>";
        }
        ?>

    </div>
</div>

<?php include("inc/footer.php"); ?>

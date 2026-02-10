<?php
include "inc/db.php";
include "inc/header.php";
?>

<style>
.hero {
    background: url('assets/banner.jpg') center/cover no-repeat;
    height: 280px;
    border-radius: 10px;
    margin-bottom: 25px;
}
.hero-text {
    background: rgba(0,0,0,0.4);
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 60%;
    margin-top: 60px;
}
.card-custom {
    border-radius: 10px;
    transition: 0.2s;
}
.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0px 4px 12px #bbb;
}
.category-box {
    padding: 10px 18px;
    margin: 5px;
    background: #f3f3f3;
    border-radius: 8px;
    display: inline-block;
}
.category-box:hover {
    background: #ddd;
}
</style>

<!-- ================= HERO SECTION ================= -->
<div class="hero d-flex align-items-center justify-content-center">
    <div class="hero-text text-center">
        <h1>Welcome to Interactive News Portal With Content Management And User Engagement</h1>
        <p>Latest News • Categories • Trending • User Engagement</p>
    </div>
</div>



<!-- ================= CATEGORY SECTION ================= -->
<div class="container mt-4">
    <h3>🗂 Browse Categories</h3>
    <hr>

    <?php
    $cat = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
    while ($row = mysqli_fetch_assoc($cat)) {
        echo "<a href='category.php?id=".$row['id']."'>
                <div class='category-box'>".$row['name']."</div>
              </a>";
    }
    ?>
</div>



<!-- ================= LATEST NEWS SECTION ================= -->
<div class="container mt-5">
    <h3>📰 Latest News</h3>
    <hr>

    <div class="row">

    <?php
    $news = mysqli_query($conn, "SELECT * FROM news ORDER BY created_at DESC LIMIT 6");

    while ($n = mysqli_fetch_assoc($news)) { ?>
        
        <div class="col-md-4 mb-4">
            <div class="card card-custom">
                <?php if (!empty($n['image'])) { ?>
                    <img src="uploads/<?php echo $n['image']; ?>" 
                         class="card-img-top" style="height:180px; object-fit:cover;">
                <?php } ?>

                <div class="card-body">
                    <h5><?php echo $n['title']; ?></h5>
                    <p class="text-muted" style="font-size:14px;">
                        <?php echo date("d M Y", strtotime($n['created_at'])); ?>
                    </p>
                    <a href="view_news.php?id=<?php echo $n['id']; ?>" class="btn btn-primary btn-sm">
                        Read More
                    </a>
                </div>
            </div>
        </div>

    <?php } ?>

    </div>
</div>



<!-- ================= TRENDING SECTION ================= -->
<div class="container mt-5 mb-5">
    <h3>🔥 Trending News</h3>
    <hr>

    <?php
    $trend = mysqli_query($conn, "
        SELECT n.id, n.title, n.created_at,
        (SELECT COUNT(*) FROM comments WHERE article_id=n.id) AS comments,
        (SELECT COUNT(*) FROM likes WHERE news_id=n.id) AS likes
        FROM news n 
        ORDER BY (comments + likes) DESC 
        LIMIT 5
    ");

    while ($t = mysqli_fetch_assoc($trend)) { ?>

        <div style="padding:12px; border-bottom:1px solid #eee;">
            <h5><?php echo $t['title']; ?></h5>
            <small>
                🗨 <?php echo $t['comments']; ?> comments |
                ❤️ <?php echo $t['likes']; ?> likes
            </small><br>
            <a href="view_news.php?id=<?php echo $t['id']; ?>">Read More</a>
        </div>

    <?php } ?>
</div>


<?php include "inc/footer.php"; ?>

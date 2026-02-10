<?php 
include("../inc/db.php");
include("../inc/header.php"); 
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">📝 News Portal – Reports & Analytics</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h4>📄 Generate News Report</h4>
                <p>Download complete news report including title, date, category & author.</p>
                <a href="report_news.php" class="btn btn-primary">Open Report</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h4>📊 Category Wise Report</h4>
                <p>View category-wise news count and data.</p>
                <a href="report_category.php" class="btn btn-success">View Report</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h4>⭐ Engagement Report</h4>
                <p>Shows likes, comments & views for each article.</p>
                <a href="report_engagement.php" class="btn btn-warning">Open Report</a>
            </div>
        </div>

    </div>
</div>

<?php include("../inc/footer.php"); ?>

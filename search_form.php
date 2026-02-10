<?php 
include("inc/header.php"); 
include("inc/db.php");
?>

<div class="container mt-4">
    <h2>Search News</h2>

    <form method="GET" action="search_result.php">
        <input type="text" name="keyword" class="form-control" placeholder="Search news here..." required>
        <button class="btn btn-primary mt-2">Search</button>
    </form>
</div>

<?php include("inc/footer.php"); ?>

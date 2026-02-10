<?php include("../inc/db.php"); ?>
<?php include("header.php"); ?>

<div class="container">

<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM news WHERE id=$id"));
?>

<h2 style="color:#0048ff; text-align:center;">✏ Edit News</h2>

<form method="POST" enctype="multipart/form-data">

<label>News Title</label>
<input type="text" name="title" value="<?= $data['title'] ?>" required>

<label>Category</label>
<select name="category">
    <option <?= $data['category']=="Politics"?"selected":"" ?>>Politics</option>
    <option <?= $data['category']=="Sports"?"selected":"" ?>>Sports</option>
    <option <?= $data['category']=="Technology"?"selected":"" ?>>Technology</option>
    <option <?= $data['category']=="Entertainment"?"selected":"" ?>>Entertainment</option>
    <option <?= $data['category']=="Business"?"selected":"" ?>>Business</option>
</select>

<label>Description</label>
<textarea name="description" rows="6"><?= $data['description'] ?></textarea>

<label>Current Image</label><br>
<img src="../uploads/<?= $data['image'] ?>" width="100"><br><br>

<label>Upload New Image (optional)</label>
<input type="file" name="image">

<button name="update">Update</button>

</form>

<?php
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['description'];

    // Image update check
    if(!empty($_FILES['image']['name'])){
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$img);
    } else {
        $img = $data['image'];
    }

    mysqli_query($conn,"UPDATE news SET 
    title='$title', category='$category', description='$desc', image='$img' WHERE id=$id");

    echo "<div class='success' style='color:green;'>✔️ Updated Successfully!</div>";
}
?>

</div>

<?php include("footer.php"); ?>

<?php
session_start();
include "../inc/db.php";
include "../inc/functions.php";
protect();

if(isset($_POST['add'])){

    $title      = clean_input($_POST['title']);
    $content    = $_POST['content']; 
    $category   = intval($_POST['category']);
    $author_id  = $_SESSION['user_id'];
    $image_name = "";

    // Image Upload
    if(!empty($_FILES['image']['name'])){
        $image_name = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/article_images/" . $image_name);
    }

    $stmt = $conn->prepare("INSERT INTO articles(title, content, category_id, image, author_id, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssisi", $title, $content, $category, $image_name, $author_id);

    if($stmt->execute()) {
        alert("Article Added!");
        redirect("manage_articles.php");
    }
    else alert("Error adding article!");
}
?>

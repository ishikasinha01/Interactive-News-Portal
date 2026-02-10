<?php
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Interactive News Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Navigation Menu -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#0f4c75;">
  <div class="container">
    <a class="navbar-brand" href="index.php">NewsPortal</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="all_news.php">All News</a></li>
        <li class="nav-item"><a class="nav-link" href="trending.php">Trending</a></li>
        <li class="nav-item"><a class="nav-link" href="search_form.php">Search</a></li>

        <li class="nav-item"><a class="nav-link" href="auth/login.php">Login</a></li>

      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">

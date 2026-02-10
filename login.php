<?php
session_start();
include("../inc/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($pass, $user['password'])) {
        
        $_SESSION['admin_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

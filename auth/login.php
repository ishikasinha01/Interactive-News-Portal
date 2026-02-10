<?php include("../inc/header.php"); ?>
<?php include("../inc/db.php"); ?>

<div class="container">
<h2 style="text-align:center; color:#005eff;">🔐 User Login</h2>

<?php
session_start();

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query)==1){
        $user = mysqli_fetch_assoc($query);

        if(password_verify($pass, $user['password'])){
            $_SESSION['user'] = $user['name'];
            echo "<div class='success'>✅ Login Successful… Redirecting</div>";
            header("refresh:1; url=dashboard.php");
        } else {
            echo "<div class='error'>❌ Incorrect Password!</div>";
        }
    } else {
        echo "<div class='error'>❌ Email not registered!</div>";
    }
}
?>

<form method="POST">
    <label>Email Address</label>
    <input type="email" name="email" required placeholder="Enter email">

    <label>Password</label>
    <input type="password" name="password" required placeholder="Enter password">

    <button type="submit" name="login">Login</button>
</form>

<p style="text-align:center; margin-top:15px;">
New user? <a href="register.php">Create Account</a>
</p>

</div>

<?php include("../inc/footer.php"); ?>



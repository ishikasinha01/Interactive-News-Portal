<?php include("../inc/header.php"); ?>
<?php include("../inc/db.php"); ?>


<div class="container">
<h2 style="text-align:center; color:#005eff;">👤 Create Your Account</h2>

<?php
if(isset($_POST['register'])){
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // check duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0){
        echo "<div class='error'>⚠️ This email is already registered!</div>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
        if($insert){
            echo "<div class='success'>✅ Registration Successful! <a href='login.php'>Login Now</a></div>";
        }else{
            echo "<div class='error'>❌ Error: Unable to register.</div>";
        }
    }
}
?>

<form method="POST">
    <label>Full Name</label>
    <input type="text" name="name" required placeholder="Enter your name">

    <label>Email Address</label>
    <input type="email" name="email" required placeholder="Enter your email">

    <label>Password</label>
    <input type="password" name="password" required placeholder="Create password">

    <button type="submit" name="register">Register</button>
</form>

<p style="text-align:center; margin-top:15px;">
Already a user? <a href="login.php">Login Here</a>
</p>

</div>

<?php include("../inc/footer.php"); ?>

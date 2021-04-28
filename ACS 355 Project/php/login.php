<?php
include_once '../includes/header.inc.php';
?>
<link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
<div class="loginbox">
    <h2>Login</h2>
    <form action="../includes/login.inc.php" method="POST" class="login1">
        <input type="text" name="phone" placeholder="Enter phone number or email" size="30"><br>
        <input type="password" name="password" placeholder="Password" size="30"><br>

        <?php
if(isset($_GET["error"])){
    if ($_GET['error']== "emptyinput"){
        echo "<p class='errorhelp'>Fill in all fields to continue...</p>";
    }elseif ($_GET['error']== "wronglogin"){
        echo "<p class='errorhelp'>Incorrect username or password</p>";
    }
}
?>


        <input type="submit" name="loginbutton" value="Login"><br>
    </form>
    <a class = "newaccount" href="signin.php">Create New Account</a>
</div>
<p class="discript">Connect and share ideas with people in the same network.</p>
<script>login();</script>
<?php
include_once '../includes/footer.inc.php';
?>
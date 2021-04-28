<?php
include_once '../includes/header.inc.php';
if(isset($_GET["error"])){

}else{

}
?>
<link rel="stylesheet" type="text/css" href="../css/stylesignin.css">
<div class="siginbox">
    <h2>Sign up</h2>
    <form action="../includes/signin.inc.php" method="POST" class="signin1">
    <?php
    if(isset($_GET["error"])){
echo '<input type="text" name="name" placeholder="Name" size="30" value ="'.$_GET["name"].'"><br>';
}else{
echo '<input type="text" name="name" placeholder="Name" size="30"><br>';
}
    if(isset($_GET["error"])){
echo '<input type="text" name="phone" placeholder="Phone number" size="30" value ="'.$_GET["phone"].'"><br>';
}else{
echo '<input type="text" name="phone" placeholder="Phone number" size="30"><br>';
}
    if(isset($_GET["error"])){
echo '<input type="text" name="email" placeholder="Email(Optional)" size="30" value ="'.$_GET["email"].'"><br>';
}else{
echo '<input type="text" name="email" placeholder="Email(Optional)" size="30"><br>';
}
echo '<input type="password" name="password1" placeholder="Password" size="30"><br>';
echo '<input type="password" name="password2" placeholder="Re-enter your password" size="30"><br>';

if(isset($_GET["error"])){
    if ($_GET['error']== "emptyinput"){
        echo "<p class='errorhelp'>Fill in all fields to continue...</p>";
    }elseif ($_GET['error']== "invalidphone"){
        echo "<p class='errorhelp'>Enter a valid phone number...</p>";
    }elseif ($_GET['error']== "invalidEmail"){
        echo "<p class='errorhelp'>Enter a valid email address...</p>";
    }elseif ($_GET['error']== "pwddontmatch"){
        echo "<p class='errorhelp'>Enter a the same password on both boxes...</p>";
    }elseif ($_GET['error']== "phoneExists"){
        echo "<p class='errorhelp'>The phone number has an account created with it already...</p>";
    }elseif ($_GET['error']== "emailExists"){
        echo "<p class='errorhelp'>The email address has an account created with it already...</p>";
    }elseif ($_GET['error']== "pwdshort"){
        echo "<p class='errorhelp'>Enter a password of six or more characters...</p>";
    }elseif ($_GET['error']== "stmtfailed"){
        echo "<p class='errorhelp'>Something went wrong. Please try again.</p>";
    }
}
?>






        <input type="submit" name="signinbutton" value="Sign up"><br>
    </form>
    <a class = "logintoaccount" href="login.ph">Login Page</a>
</div>
<p class="discript">Connect and share ideas with people in the same network.</p>
<script>signin();</script>
<?php
include_once '../includes/footer.inc.php';
?>
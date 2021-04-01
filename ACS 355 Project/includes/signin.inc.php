<?php
if(isset($_POST["signinbutton"])){
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputSignup($name, $phone, $password1, $password2) !== false){
    header("Location: ../php/signin.php?error=emptyinput");
    exit();
}

if(invalidPhone($phone) !== false){
    header("Location: ../php/signin.php?error=invalidphone");
    exit();
}

if(invalidEmail($email) !== false){
    header("Location: ../php/signin.php?error=invalidEmail");
    exit();
}

if(pwdmatch($password1, $password2) !== false){
    header("Location: ../php/signin.php?error=pwddontmatch");
    exit();
}

if(phoneExists($conn, $phone) !== false){
    header("Location: ../php/signin.php?error=phoneExists");
    exit();
}

if(pwdShort($password1) !== false){
    header("Location: ../php/signin.php?error=pwdshort");
    exit();
}

createUser($conn, $name, $phone, $email, $password1);


}else{
header("Location: ../php/login.php");
exit();
}
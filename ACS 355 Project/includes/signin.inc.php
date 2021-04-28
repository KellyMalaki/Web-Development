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
    header("Location: ../php/signin.php?error=emptyinput&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(invalidPhone($phone) !== false){
    header("Location: ../php/signin.php?error=invalidphone&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(invalidEmail($email) !== false){
    header("Location: ../php/signin.php?error=invalidEmail&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(pwdmatch($password1, $password2) !== false){
    header("Location: ../php/signin.php?error=pwddontmatch&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(phoneExists($conn, $phone) !== false){
    header("Location: ../php/signin.php?error=phoneExists&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(emailExists($conn, $email) !== false){
    header("Location: ../php/signin.php?error=emailExists&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

if(pwdShort($password1) !== false){
    header("Location: ../php/signin.php?error=pwdshort&name=".$name."&phone=".$phone."&email=".$email);
    exit();
}

createUser($conn, $name, $phone, $email, $password1);


}else{
header("Location: ../php/login.php");
exit();
}
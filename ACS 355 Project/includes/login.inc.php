<?php
if(isset($_POST["loginbutton"])){
$phone = $_POST["phone"];
$password = $_POST["password"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputLogin($phone, $password) !== false){
    header("Location: ../php/login.php?error=emptyinput");
    exit();
}

loginUser($conn, $phone, $password);

}else{
    header("Location: ../php/login.php");
    exit();
    }
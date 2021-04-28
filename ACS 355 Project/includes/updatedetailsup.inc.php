<?php
session_start();
if(isset($_POST["upsubmit"])){
$name = $_POST["upname"];
$phone = $_POST["phone"];
$email = $_POST["email"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputSignup2($name, $phone) !== false){
    header("Location: ../php/hpuserprofile.php?error=emptyinput");
    exit();
}

if(invalidPhone($phone) !== false){
    header("Location: ../php/hpuserprofile.php?error=invalidphone");
    exit();
}

if(invalidEmail($email) !== false){
    header("Location: ../php/hpuserprofile.php?error=invalidEmail");
    exit();
}

if(phoneExists2($conn, $phone) !== false){
    header("Location: ../php/hpuserprofile.php?error=phoneExists");
    exit();
}

if(emailExists2($conn, $email) !== false){
    header("Location: ../php/hpuserprofile.php?error=emailExists");
    exit();
}
$userid= strval($_SESSION["usersId"]);
uupdateuserdetails($conn, $name, $phone, $email, $userid);


}else{
header("Location: ../php/updatedetailsup.inc.php");
exit();
}
<?php
if(isset($_POST["btncreatenetwork"])){
$netname = $_POST["netname"];
$type = $_POST["network_type"];
$privacy = $_POST["privacy_mode"];
$description = $_POST["description"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputNetwork($netname, $description, $password1, $password2) !== false){
    header("Location: ../php/network.php?error=emptyinput");
    exit();
}

if(pwdmatch($password1, $password2) !== false){
    header("Location: ../php/network.php?error=pwddontmatch");
    exit();
}

if(pwdShort($password1) !== false){
    header("Location: ../php/network.php?error=pwdshort");
    exit();
}

createNetwork($conn, $netname, $type, $privacy, $description, $password1);


}else{
header("Location: ../php/network.php");
exit();
}
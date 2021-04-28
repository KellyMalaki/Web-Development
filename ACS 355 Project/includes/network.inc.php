<?php
session_start();
if(isset($_POST["btncreatenetwork"])){
$netname = $_POST["netname"];
$type = $_POST["network_type"];
$privacy = $_POST["privacy_mode"];
$description = $_POST["description"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputNetwork($netname, $description) !== false){
    header("Location: ../php/hpcreatenetwork.php?error=emptyinput");
    exit();
}

if(checknetworkname($conn, $netname) !== false){
    header("Location: ../php/hpcreatenetwork.php?error=networkexists");
    exit();
}

createNetwork($conn, $netname, $type, $privacy, $description);


}else{
header("Location: ../php/hpcreatenetwork.php");
exit();
}
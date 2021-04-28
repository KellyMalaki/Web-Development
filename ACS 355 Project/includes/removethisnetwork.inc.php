<?php
require_once "dbh.inc.php";
session_start();

//confirm that the network belongs to the user

$sql = "SELECT usersId FROM networkusers WHERE usersId=? AND networksId =?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "ss", $_SESSION["usersId"], $_GET["NetworksId"]);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
if($row = mysqli_fetch_assoc($resultData)){
    //This is good where we remove network and clear session networks id
    $sql2 = "DELETE FROM networkusers WHERE usersId=? AND networksId =?;";
$stmt2 = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt2, $sql2)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt2, "ss", $_SESSION["usersId"], $_GET["NetworksId"]);
$done =mysqli_stmt_execute($stmt2);
if($done){
    //Everything done
    unset($_SESSION["NetworksId"]);
    unset($_SESSION['NetworksName']);
    
}
mysqli_stmt_close($stmt2);

    //Ends here
}
mysqli_stmt_close($stmt);
//Check that network has no users.
$sql = "SELECT usersId FROM networkusers WHERE NetworksId=?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $_GET["NetworksId"]);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$yesusers;
if($row = mysqli_fetch_assoc($resultData)){
    $yesusers=true;
}else{
    $yesusers=false;
}
mysqli_stmt_close($stmt);







if($yesusers ==false){
//Delete network
$sql2 = "DELETE FROM networks WHERE NetworksId=?;";
$stmt2 = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt2, $sql2)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt2, "s", $_GET["NetworksId"]);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

//network deleted
}
//if function ends

header("location: ../php/homepage.php");
exit();
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
    //This is good
    $_SESSION['NetworksId']= $_GET["NetworksId"];
    $kelly = $_GET["NetworksId"];
    $query = "select NetworksName from networks where NetworksId = '$kelly' limit 1;";
       $result = mysqli_query($conn, $query);
       $user_data = mysqli_fetch_assoc($result);
       $_SESSION['NetworksName'] = $user_data["NetworksName"];
}
mysqli_stmt_close($stmt);

header("location: ../php/homepage.php");
exit();
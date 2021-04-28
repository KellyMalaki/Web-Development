<?php
require_once "dbh.inc.php";
session_start();
//remove all networks then delete account then clear session and go to index page

    //This is good where we remove network and clear session networks id
    $sql2 = "DELETE FROM networkusers WHERE usersId=?;";
$stmt2 = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt2, $sql2)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt2, "s", $_SESSION["usersId"]);
$done1 =mysqli_stmt_execute($stmt2);
if($done1){
    //Delete messages here


    $sql3 = "DELETE FROM messages WHERE usersId=?;";
$stmt3 = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt3, $sql3)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt3, "s", $_SESSION["usersId"]);
$done3 =mysqli_stmt_execute($stmt3);
if($done3){
    //Messages deleted now delete account
    $sql = "DELETE FROM users WHERE usersId=?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $_SESSION["usersId"]);
$done =mysqli_stmt_execute($stmt);
if($done){
    //Account is deleted now. Clear the session and leave
session_unset();
session_destroy();
    
    
}
mysqli_stmt_close($stmt);

    //Account is deleted here
}
mysqli_stmt_close($stmt3); 
    
}
mysqli_stmt_close($stmt2);

    //Ends here

header("location: ../php/index.php");
exit();
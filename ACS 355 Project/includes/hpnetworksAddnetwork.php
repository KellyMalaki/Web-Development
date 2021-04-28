<?php
require_once "dbh.inc.php";
session_start();

//Confirm that the network is open first


//Confirm that user does not belong in the said group too

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
    //This is not good
    mysqli_stmt_close($stmt);
}else{
//Confirm that the network is open then add them
mysqli_stmt_close($stmt);



//here
$sql2 = "SELECT NetworksPrivacy FROM networks WHERE NetworksId =?;";
$stmt2 = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt2, $sql2)){
    header("location: ../php/login.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt2, "s", $_GET["NetworksId"]);
mysqli_stmt_execute($stmt2);
$resultData2 = mysqli_stmt_get_result($stmt2);
if($row2 = mysqli_fetch_assoc($resultData2)){
    if($row2["NetworksPrivacy"]=== "Open"){
        //Add to network here


        $netid = $_GET["NetworksId"];
        $userid = $_SESSION["usersId"];
        $sql3 = "INSERT INTO networkusers (usersId, NetworksId, userstate) VALUES (?, ?, ?);";
        $stmt3 = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt3, $sql3)){
            header("location: ../php/homepage.php?error=stmtfailed");
            exit();
        }
     
        
         $userstate = "user";
        mysqli_stmt_bind_param($stmt3, "sss", $userid , $netid, $userstate);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
        $_SESSION['NetworksId']= $netid;
        unset($_SESSION['NetworksName']);
        //stop here
    }
    mysqli_stmt_close($stmt2);
}else{
    mysqli_stmt_close($stmt2);
}
}


header("location: ../php/homepage.php");
exit();
<?php
require_once "../includes/dbh.inc.php";
require_once "../includes/function-loop.inc.php";
session_start();
if (isset($_SESSION["usersId"])){
    if(!isset($_SESSION['NetworksId'])){
    $holder;
    $sql = "SELECT NetworksId FROM networkusers WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $_SESSION["usersId"]);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        $holder= $row;
    }else{
        $holder = false;
    }
    mysqli_stmt_close($stmt);
    if($holder != false){
        $_SESSION['NetworksId'] = $holder["NetworksId"];
    }
}
}else{
    header("location: login.php");
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umoja</title>
</head>
<body>
    
    <link rel="stylesheet" type="text/css" href="../css/stylehomepage.css">
<div class="navbar">
        <nav>
            <ul class="primary-nav">
                <li id="home" class="current"><a href="homepage.php">
<?php
if(!isset($_SESSION['NetworksId'])){
    echo "No network yet";
}else{
    if(isset($_SESSION['NetworksName'])){
        echo $_SESSION['NetworksName'];
    }else{
    $kelly = $_SESSION['NetworksId'];
 $query = "select NetworksName from networks where NetworksId = '$kelly' limit 1;";
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);
    $_SESSION['NetworksName'] = $user_data["NetworksName"];    
    echo $user_data["NetworksName"];
    }
}
?>
                </a></li>
                <li id="userprofile"><a href="hpuserprofile.php">User Profile</a></li>
                <li id="discussions"><a href="managenetworks.php">My Networks</a></li>
                <li id="networks"><a href="hpnetworks.php">Add Networks</a></li>
                <li id="createnetwork"><a href="hpcreatenetwork.php">Create Network</a></li>
                <li id="logout"><a href="../includes/logout.inc.php">Log out</a></li>
            </ul>
        </nav>
</div><br>
<div class="bodyholder">
<script src="../javascript/onlogin.js"></script>
<?php
if(!isset($_GET['pos'])){
    echo '<p class="welcomeuser">'.getnameonly($conn).'.</p>';
}else{
    echo '<p class="welcomeuser">Welcome, '.getnameonly($conn).'.</p>';    
}
?>

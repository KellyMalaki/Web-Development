<?php
require_once "../includes/dbh.inc.php";
session_start();
if (isset($_SESSION["usersId"])){
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
    $_SESSION['NetworksId'] = $holder["NetworksId"];

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
                <li id="home" class="current"><a href="#">
<?php
if(!$_SESSION['NetworksId']){
    echo "No network yet";
}else{
    $kelly = $_SESSION['NetworksId'];
 $query = "select NetworksName from networks where NetworksId = '$kelly' limit 1;";
    $result = mysqli_query($conn, $query);
            $user_data = mysqli_fetch_assoc($result);
    echo $user_data["NetworksName"];
}
?>
                </a></li>
                <li id="userprofile"><a href="#">User Profile</a></li>
                <li id="discussions"><a href="#">My discussions</a></li>
                <li id="networks"><a href="#">Networks</a></li>
                <li id="logout"><a href="../includes/logout.inc.php">Log out</a></li>
            </ul>
        </nav>
</div><br>
<form action="../includes/messages.inc.php" method="POST" class="typing">
    <textarea name= "themessage" id= "themessage" cols= "100" rows="8" placeholder="Type your message here..."></textarea><br>
    <input type="submit" name="send" value="Send"><br>
</form>
<?php
if(isset($_GET["message"])){
    if ($_GET['message']== "sent"){
        echo "<p class='messagesent'>Message sent</p>";
    }
}
?>

<br>

<?php
$netid = $_SESSION['NetworksId'];
$query = "select themessage from messages where NetworksId = $netid;";
$resulta = mysqli_query($conn, $query);
if($resulta){
    if($resulta && mysqli_num_rows($resulta) > 0)
    {
        $user_data = mysqli_fetch_assoc($resulta);
    
    require_once "../includes/function-loop.inc.php";
    getmessage($conn, $user_data);
}

}

?>
</body>
</html>
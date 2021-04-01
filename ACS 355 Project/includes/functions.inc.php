<?php
function emptyInputSignup($name, $phone, $password1, $password2){
    $result;
    if(empty($name) || empty($phone)|| empty($password1)|| empty($password2)){
    $result = true;
    }else{
    $result = false;
    }
    return $result;
}

function invalidPhone($phone){
    $result;
    if(strlen($phone)>10){
    if(!preg_match('/^[0-9 +-]*$/', $phone)){
    $result = true;
    }else{
    $result = false;
    }}else{
    $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if($email == ""){
        $result = false;
    }else{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result = true;
    }else{
    $result = false;
    }
}
    return $result;
}

function pwdmatch($password1, $password2){
    $result;
    if($password1 !== $password2){
    $result = true;
    }else{
    $result = false;
    }
    return $result;
}

function phoneExists($conn, $phone){
    $sql = "SELECT * FROM users WHERE usersPhonenumber= ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/signin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $phone);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function pwdShort($password1){
    $result;
    if(strlen($password1)<6){
    $result = true;
    }else{
    $result = false;
    }
    return $result;

}

function createUser($conn, $name, $phone, $email, $password1){
    $sql = "INSERT INTO users (usersName, usersPhonenumber, usersEmail, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/signin.php?error=stmtfailed");
        exit();
    }

    $hashedpwd = password_hash($password1, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $phone, $email, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $userexists1;
    $sql = "SELECT usersId FROM users WHERE usersPhonenumber=?;";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_bind_param($stmt, "s", $phone);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        $userexists1= $row;
    }else{
        $userexists1 = false;
    }
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION["usersId"] = $userexists1["usersId"];
    header("location: ../php/homepage.php");
        exit();
}

function emptyInputLogin($phone, $password){
    $result;
    if(empty($phone) || empty($password)){
    $result = true;
    }else{
    $result = false;
    }
    return $result;
}

function loginUser($conn, $phone, $password){
    $userexists;
    $sql = "SELECT * FROM users WHERE usersPhonenumber=? OR usersEmail =?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $phone, $phone);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        $userexists= $row;
    }else{
        $userexists = false;
    }
    mysqli_stmt_close($stmt);

    if($userexists === false){
        header("Location: ../php/login.php?error=wronglogin");
    exit();
    }
    $pwdHashed = $userexists["usersPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("Location: ../php/login.php?error=wronglogin");
        exit();  
    } else if($checkPwd === true){
        session_start();
        $_SESSION["usersId"] = $userexists["usersId"];
        header("location: ../php/homepage.php");
        exit();
    }
}

function emptyInputNetwork($netname, $description, $password1, $password2){
    $result;
    if(empty($netname) || empty($description)|| empty($password1)|| empty($password2)){
    $result = true;
    }else{
    $result = false;
    }
    return $result;
}

function createNetwork($conn, $netname, $type, $privacy, $description, $password1){
    $sql = "INSERT INTO networks (NetworksName, NetworksType, NetworksPrivacy, Networksdescription, NetworksPwd) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/network.php?error=stmtfailed");
        exit();
    }

    $hashedpwd = password_hash($password1, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $netname, $type, $privacy, $description, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../php/addusers.php?id=one");
    session_start();
    $_SESSION['netname']= $netname;
    exit();
}

function emptyadmin($admin){
    $result;
    if(empty($admin)){
    $result = true;
    }else{
    $result = false;
    }
    return $result;
}

function addoneuser($conn, $one){
       $moja = 1;
        $mbili = 3;
        $tatu = "admin";

    
        $userexists;
        $sql = "SELECT * FROM users WHERE usersName=?;";
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../php/login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $one);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            $userexists= $row;
        }else{
            $userexists = false;
        }
        mysqli_stmt_close($stmt);
    
        if($userexists === false){
            header("Location: ../php/addusers.php?error=something");
        exit();
        }else{
        $userid = $userexists['usersId'];
        session_start();
        $onen = $_SESSION['netname'];
       $querytemp = "SELECT NetworksId FROM networks WHERE NetworksName = '$onen'; ";
       $tempresult = mysqli_query($conn, $querytemp);
       if($tempresult && mysqli_num_rows($tempresult) > 0)
       {
           $user_data = mysqli_fetch_assoc($tempresult);
       }
       $netid = $user_data['NetworksId'];
       $sql2 = "INSERT INTO networkusers (usersId, NetworksId, userstate) VALUES (?, ?, ?);";
       $stmt = mysqli_stmt_init($conn);
   
       if(!mysqli_stmt_prepare($stmt, $sql2)){
           header("location: ../php/signin.php?error=stmtfailed");
           exit();
       }
    
       
        $userstate = "admin";
       mysqli_stmt_bind_param($stmt, "sss", $userid , $netid, $userstate);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);
       $_SESSION['userid']= $userid;
       $_SESSION['netid'] = $netid;
    }}

function adduserstonet($conn, $admin, $admin2, $admin3){
    addoneuser($conn, $admin);
    if($admin2){
    addoneuser($conn, $admin2);
}
if($admin3){
    addoneuser($conn, $admin3);
}
    $userid=$_SESSION['userid'];
    $netid=$_SESSION['netid'];
    header("location: ../php/index.php?userid=$userid&netid=$netid");
    exit();
}

function sendmessage($conn, $themessage){
    //$sql = "INSERT INTO messages(usersId, NetworksId , themessage ) VALUES (?, ?, ?);";
    session_start();
    $a= $_SESSION["NetworksId"];
    $b = $_SESSION["usersId"];
    $query = "insert into messages (usersId, NetworksId , themessage) values ('$b', '$a', '$themessage')";
    $result = mysqli_query($conn, $query);
    /*$stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../php/homepage.php?error=stmtfailed");
        exit();
    }else{
    session_start();
    $a= $_SESSION["NetworksId"];
    $b = $_SESSION["usersId"];
   $themessage ="Hello";
    mysqli_stmt_bind_param($stmt, "sss", $b, $a, $themessage);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);*/
    header("location: ../php/homepage.php?message=sent");
}
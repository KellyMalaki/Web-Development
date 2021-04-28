<?php
function getnameonly($conn){
    if(!isset($_SESSION["userName"])){
    $one = $_SESSION["usersId"];

    $query = "SELECT usersName FROM users where usersId= '$one' limit 1;";
    $result = mysqli_query($conn, $query);

    if($result){
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION["userName"]=$row['usersName'];
           return $row['usersName'];
        }else{
            return "Error finding name";
        }
            }else{
            return "Error finding name";
            }
    }else{
        return $_SESSION["userName"];
    }

}
function getmessage($conn, $user_data){
    $one= $_SESSION["NetworksId"];
    $query = "SELECT usersName , themessage FROM users INNER JOIN messages ON users.usersId = messages.usersId where NetworksId= '$one' order by messageid";
    $result = mysqli_query($conn, $query);

    if($result){
        if($result && mysqli_num_rows($result) > 0)
        {
           // $user_data = mysqli_fetch_assoc($result);

            while ($user_data = mysqli_fetch_assoc($result)) {
                echo '<div class="chatbar">';
    echo '<p class ="typer" id="typer">'.$user_data['usersName'].'</p>';
    echo '<p class="message" id="message">'.$user_data['themessage'].'</p></div>';
            }
        }
}
}

function getnetworks($conn, $searchedkey){	
$query= "SELECT DISTINCT networks.NetworksId, NetworksName, NetworksType, Networksdescription FROM networks INNER JOIN networkusers ON networks.NetworksId = networkusers.NetworksId WHERE NetworksPrivacy = 'Open' AND NetworksName LIKE '%".$searchedkey."%'".getallmynetworksid($conn, $_SESSION["usersId"]);
$result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            while ($user_data = mysqli_fetch_assoc($result)) {
    echo '<a class="networkclickable" href="../includes/hpnetworksAddnetwork.php?NetworksId='.$user_data["NetworksId"].'">';
    echo '<p class="networkname">'.$user_data['NetworksName'].'<span class="networktype"> - '.$user_data['NetworksType'].'</span></p>';
    echo '<p class="discription">'.$user_data["Networksdescription"].'</p>';
    echo '<span class="line2"></span></a>';
            }
        }else{
        echo "<p class='discription'>No open network with such a name exists</p>";
        }

}

function allthenetworks($conn){	
    $query= "SELECT DISTINCT networks.NetworksId, NetworksName, NetworksType, Networksdescription FROM networks INNER JOIN networkusers ON networks.NetworksId = networkusers.NetworksId WHERE NetworksPrivacy = 'Open'".getallmynetworksid($conn, $_SESSION["usersId"]);
    $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0)
            {
                while ($user_data = mysqli_fetch_assoc($result)) {
        echo '<a class="networkclickable" href="../includes/hpnetworksAddnetwork.php?NetworksId='.$user_data["NetworksId"].'">';
        echo '<p class="networkname">'.$user_data['NetworksName'].'<span class="networktype"> - '.$user_data['NetworksType'].'</span></p>';
        echo '<p class="discription">'.$user_data["Networksdescription"].'</p>';
        echo '<span class="line"></span></a>';
                }
            }else{
            echo "<p class='discription'>No free network exists yet. You can create one if you like.</p>";
            }
    
    }

    function allmynetworks($conn, $usersId){	
        $query= "SELECT networks.NetworksId, NetworksName, NetworksType, Networksdescription FROM networks INNER JOIN networkusers ON networks.NetworksId = networkusers.NetworksId WHERE usersId=".$usersId.";";
        $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) > 0)
                {
                    while ($user_data = mysqli_fetch_assoc($result)) {
            echo '<a class="networkclickable" href="../includes/mynetworkchanger.inc.php?NetworksId='.$user_data["NetworksId"].'">';
            echo '<p class="networks">'.$user_data['NetworksName'].'<span class="networktype"> - '.$user_data['NetworksType'].'</span></p>';
            echo '<p class="discription">'.$user_data["Networksdescription"].'</p></a>';
            echo '<span class="line"></span>';

                    }
                }else{
                echo "<p class='discription'>You don't belong to any network yet. Choose a free one to join it.</p>";
                }
        
        }

        function getallmynetworksid($conn, $usersId){	
            $query= "SELECT NetworksId FROM networkusers WHERE usersId=".$usersId.";";
            $result = mysqli_query($conn, $query);
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        $alladded="";
                        while ($user_data = mysqli_fetch_assoc($result)) {
                $alladded=$alladded.' AND networks.NetworksId !='.$user_data['NetworksId'];
                        }
                    return $alladded.";";
                    }
                    return ';'; 
            }

            function allmynetworksdelete($conn, $usersId){	
                $query= "SELECT networks.NetworksId, NetworksName, NetworksType, Networksdescription FROM networks INNER JOIN networkusers ON networks.NetworksId = networkusers.NetworksId WHERE usersId=".$usersId.";";
                $result = mysqli_query($conn, $query);
                        if($result && mysqli_num_rows($result) > 0)
                        {
                            while ($user_data = mysqli_fetch_assoc($result)) {
                    echo '<div class="netholder"><p class="networks">'.$user_data['NetworksName'].'<span class="networktype"> - '.$user_data['NetworksType'].'</span></p>';
                    echo '<p class="discription">'.$user_data["Networksdescription"].'</p>';
                    echo '<a class="removenetworkbtn" href="../includes/removethisnetwork.inc.php?NetworksId='.$user_data["NetworksId"].'">Remove this Network</a>';
                    echo '<span class="lineup"></span></div>';
        
                            }
                        }else{
                        echo "<p class='discription'>You don't belong to any network yet. Choose a free one to join it.</p>";
                        }
                
                }
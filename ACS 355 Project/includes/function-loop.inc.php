<?php
function getmessage($conn, $user_data){
    //Display names
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
<?php
include_once '../includes/header-homepage.inc.php';
?>

<div class="userdetailsdiv">
    <form action="../includes/updatedetailsup.inc.php" method="POST"><br>
        <table>
            <?php
            //Get original data



            $one= $_SESSION["usersId"];
            $query = "SELECT usersName , usersPhonenumber, usersEmail FROM users where usersId= '$one';";
            $result = mysqli_query($conn, $query);
        
            if($result){
                if($result && mysqli_num_rows($result) > 0)
                {
        
                    while ($user_data = mysqli_fetch_assoc($result)) {
                   $nname = $user_data["usersName"];
                   $pphone = $user_data["usersPhonenumber"];
                   $eemail =  $user_data["usersEmail"];
                    }
                }
        }






            //till here
        echo '<tr><td><span class="upformlabels">Name : </span></td>';
        echo '<td><input class="upforminputtext" type="text" name="upname" id="upname" value ="'.$nname.'"></td></tr>';
        echo '<tr><td><span class="upformlabels">Phone Number : </span></td>';
        echo '<td><input class="upforminputtext" type="text" name="phone" id="phone" value ="'.$pphone.'"></td></tr>';
        echo '<tr><td><span class="upformlabels">Email : </span></td>';
        echo '<td><input class="upforminputtext" type="text" name="email" id="email" value ="'.$eemail.'"></td></tr>';


        if(isset($_GET["error"])){
            if ($_GET['error']== "emptyinput"){
                echo "<p class='errorhelp'>Fill in all fields to update...</p>";
            }elseif ($_GET['error']== "invalidphone"){
                echo "<p class='errorhelp'>Enter a valid phone number...</p>";
            }elseif ($_GET['error']== "invalidEmail"){
                echo "<p class='errorhelp'>Enter a valid email address...</p>";
            }elseif ($_GET['error']== "phoneExists"){
                echo "<p class='errorhelp'>The phone number has an account created with it already...</p>";
            }elseif ($_GET['error']== "emailExists"){
                echo "<p class='errorhelp'>The email address has an account created with it already...</p>";
            }elseif ($_GET['error']== "stmtfailed"){
                echo "<p class='errorhelp'>Something went wrong. Please try again.</p>";
            }elseif ($_GET['error']== "accountupdated"){
                echo "<p class='errorhelp'>Account Updated.</p>";
            }
        }
            ?>
            <tr><td><input class="upformsubmit" type="submit" name ="upsubmit" value="Update Account"></td></tr>
    </table>
    </form>

    <span class="line"></span>

    <h1 class="mynetworkstag">My Networks</h1>


    <! Repeat starts here>
    <div class="mynetworks">
    <script src="../javascript/hpuserprofilepopup.js"></script>
    <?php
require_once "../includes/dbh.inc.php";
require_once "../includes/function-loop.inc.php";

echo '<div class="mynetworks">';

allmynetworksdelete($conn, $_SESSION["usersId"]);
echo '</div>';
?>



    <! Repeat stops here>
    
</div>


    <td>
    </td>



</div>
<div class="deleteaccountholder">
<a href="../includes/hpdeleteaccount.inc.php" class="deleteaccount">DELETE ACCOUNT</a>
</div>


    </body>
</html>
    <script>userprofile();</script>



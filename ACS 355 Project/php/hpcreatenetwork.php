<?php
include_once '../includes/header-homepage.inc.php';
?>
<link rel="stylesheet" type="text/css" href="../css/stylecreatenetwork.css">

<div class="networkbox">
    <h2>New Network</h2>
    <form action="../includes/network.inc.php" method="POST" class="network1">
        <input type="text" name="netname" placeholder="Network Name" size="30"><br>
       

        <select name = "network_type" class="nettype">
            <option value = "School System" selected>School System</option>
            <option value = "Company System">Company System</option>
            <option value = "Business System">Business System</option>
            <option value = "Socializing System">Socializing System</option>
         </select> <br>

         <select name = "privacy_mode" class="prvcymode">
            <option value = "Open" selected>Open(Anyone Can Join)</option>
            <option value = "Ask Permision first">Ask Permision first</option>
            <option value = "Users can only be added">Users can only be added</option>
         </select> <br>
        <textarea name= "description" id= "description" cols= "30" rows="5" placeholder="Enter the Network Description here..."></textarea><br>


        <?php
if(isset($_GET["error"])){
    if ($_GET['error']== "emptyinput"){
        echo "<p class='errorhelp'>Fill in all fields to continue...</p>";
    }elseif ($_GET['error']== "networkexists"){
        echo "<p class='errorhelp'>Network name already exists</p>";
    }
}
?>


        <input type="submit" name="btncreatenetwork" value="Create Network"><br>
    </form>
</div>
<p class="discript">Create a network which users can join and interact.</p>
</body>
</html>
<script>createnetwork();</script>
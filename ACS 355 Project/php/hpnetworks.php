<?php
include_once '../includes/header-homepage.inc.php';
?>

<h1 class="mynetworkstag">My Networks</h1>
<?php
require_once "../includes/dbh.inc.php";
require_once "../includes/function-loop.inc.php";

echo '<div class="mynetworks">';
allmynetworks($conn, $_SESSION["usersId"]);
echo '</div>';
?>
<h2>Add Networks</h2>
<div class="mynetworks">
    <form class="searchbar" method="GET" action="../includes/hpnetworks.inc.php">
    <?php
     if(isset($_GET["searched"])){
echo '<input type="text" name = "searchtext" placeholder="Input to filter the results" value="'.$_GET["searched"].'">';
     }else{
      echo '<input type="text" name = "searchtext" placeholder="Input to filter the results">';
     }
    ?>
        <input type="image" src="../Images/search.svg" value="Search">  
    </form>
    <span class="line2"></span>
<?php
    if(isset($_GET["searched"])){
        getnetworks($conn, $_GET["searched"]);
    }else{
        allthenetworks($conn);
    }
?>
</div>

</div>
</body>
</html>
<script>networks();</script>
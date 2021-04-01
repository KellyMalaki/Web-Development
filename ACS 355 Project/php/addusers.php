<?php
include_once '../includes/header.inc.php';
?>
<link rel="stylesheet" type="text/css" href="../css/stylenetworkinitialize.css">
    <h2>Finalize creating account</h2>
    <form action="../includes/addusers.inc.php" method="POST" class="login1">
        <p>Add the Admin users below</p>
        <input type="text" name="admin" placeholder="Enter user's name" size="30"><br>
        <input type="text" name="admin2" placeholder="Second Admin(Optional)" size="30"><br>
        <input type="text" name="admin3" placeholder="Third Admin(Optional)" size="30"><br>
        <input type="submit" name="createnetwork" value="Finalize network"><br>
    </form>
    <a class = "crtnetwork" href="#">Create a new Network</a>
</div>
<p class="discript">Connect and share with people in the same network.</p>
<script>network();</script>
<?php
include_once '../includes/footer.inc.php';
?>
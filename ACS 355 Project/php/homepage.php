<?php
include_once '../includes/header-homepage.inc.php';
?>

<form action="../includes/messages.inc.php" method="POST" class="typing">
    <textarea name= "themessage" id= "themessage" cols= "100" rows="8" placeholder="Type your message here..."></textarea><br>
    <input class ="submit" type="submit" name="send" value="Send"><br>
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
if(isset($_SESSION['NetworksId'])){
$netid = $_SESSION['NetworksId'];
$query = "select themessage from messages where NetworksId = $netid;";
$resulta = mysqli_query($conn, $query);
if($resulta){
    if($resulta && mysqli_num_rows($resulta) > 0)
    {
        $user_data = mysqli_fetch_assoc($resulta);
    getmessage($conn, $user_data);
}

}
}else{
    echo '<div class="chatbar">';
    echo '<p class="message" id="message">You belong to no network yet. Join one from the Networks tab.</p></div>';
}

?>
</div>
</body>
</html>
<script>home();</script>
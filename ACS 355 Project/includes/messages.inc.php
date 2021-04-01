<?php
if(isset($_POST["send"])){
$themessage = $_POST["themessage"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

sendmessage($conn, $themessage);
}
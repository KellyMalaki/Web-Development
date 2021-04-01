<?php
if(isset($_POST["createnetwork"])){
$admin = $_POST["admin"];
$admin2 = $_POST["admin2"];
$admin3 = $_POST["admin3"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyadmin($admin) !== false){
    header("Location: ../php/addusers.php?error=emptyadmin");
    exit();
}

adduserstonet($conn, $admin, $admin2, $admin3);

}else{
    header("Location: ../php/addusers.php?error=emptyinput");
    exit();
    }
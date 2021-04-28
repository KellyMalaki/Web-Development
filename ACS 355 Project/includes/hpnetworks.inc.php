<?php
session_start();
$_SESSION["searched"]=true;
header("Location: ../php/hpnetworks.php?searched=".$_GET["searchtext"]);
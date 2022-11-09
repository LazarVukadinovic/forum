<?php   
session_start(); 
$_SESSION["loggedIn"] = 0;
header("location:/index.php"); 
exit();
?>
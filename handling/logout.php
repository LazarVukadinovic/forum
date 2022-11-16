<?php   
session_start(); 
$_SESSION["loggedIn"] = 0;
$_SESSION["user"] = "";
if(isset($_SESSION["currentURL"]))
    header('Location: ' . $_SESSION["currentURL"]); 
else
    header("location:/index.php"); 
exit();
?>
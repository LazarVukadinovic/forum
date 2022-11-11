<?php 
    session_start();
    include "../connection.php";
    $sql = "DELETE FROM komentari WHERE id_kom=" . $_GET["id"];
    $result = $conn->query($sql);
    if(isset($_SESSION["currentURL"]))
        header('Location: http://nemanaziv.com/diskusija.php?id=' . $_SESSION["idTeme"]); 
?>
<?php 

    include "../connection.php";
    $sql = "DELETE FROM komentari WHERE id_tema = " . $_GET["id"];
    $result = $conn->query($sql);
    $sql = "DELETE FROM tema WHERE id=" . $_GET["id"];
    $result = $conn->query($sql);
    header("Location: /index.php");
?>
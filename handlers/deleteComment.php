<?php
    include "../connection.php";
    $sql = "DELETE FROM komentari WHERE id_kom=" . $_GET["id"];
    $result = $conn->query($sql);
    header('Location: ../diskusija.php?id=' . $_GET["idP"]); 
?>
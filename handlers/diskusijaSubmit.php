<?php
include "../connection.php";
session_start();
    $komentar = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["komentar"]))
        {
            $komentar = test_input($_POST["komentar"]);
        }

        
    }
    if(!empty($komentar))
    {
        $datum = date("Y-m-d H:i");
        $sql = "INSERT INTO komentari (id_tema, ime_kreatora, opis, datum)
        VALUES(" . $_GET["id"] . ", '" . $_SESSION["username"] . "', '" . $komentar . "', '" . $datum . "')";
        $result = $conn->query($sql);
        header("Location: ../diskusija.php?id=" . $_GET["id"]);
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
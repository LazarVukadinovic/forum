<?php 
    session_start();
    include "../connection.php";

        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = "jpg";

        $newFileName = $_SESSION["user"] . '.' . $fileExtension;

        $uploadFileDir = '../avatars/';
        $dest_path = $uploadFileDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path))
        {
            $sql = "UPDATE korisnik SET slika = '" . $newFileName . "' WHERE korisnicko_ime = '" . $_SESSION["user"] . "'";
            $result = $conn->query($sql);
        }
        

    header("Location: ../account.php");


?>
<?php 
    session_start();
    include "../connection.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $target_dir = "avatars/";
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            
            
            // Insert image content into database 
            //$insert = $conn->query("UPDATE korisnik SET slika = '$imgContent' WHERE korisnicko_ime = '" . $_SESSION["user"] . "'"); 
        }
    }
    header("Location: ../account.php");


?>
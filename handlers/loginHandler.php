<?php 
session_start();
include "../connection.php";
$userErr = $userPasswordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["username"]))
        {
        $userErr = "Morate uneti username";
        }
        else
        {
            $username = test_input($_POST["username"]);
            $userErr = "";
        }

        if (empty($_POST["password"]))
        {
            $userPasswordErr = "Morate uneti password";
        }
        else
        {
            $password = test_input($_POST["password"]);
            $userPasswordErr = "";
        }
    }

    if(!empty($username) && !empty($password))
    {
        $sql = "SELECT korisnicko_ime, lozinka FROM korisnik WHERE korisnicko_ime = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
            
        if ($result->num_rows > 0) {
        if($row["korisnicko_ime"] == $username && password_verify($password, $row["lozinka"]))
        {
            $_SESSION["username"] = $row["korisnicko_ime"];
            header("location: ../"); 
        }
                        
    }
}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    header("location: ../"); 
?>
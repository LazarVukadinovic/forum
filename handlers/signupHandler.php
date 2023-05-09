<?php 
session_start();
include "../connection.php";
    $userErr = $userPasswordErr = $userRPasswordErr = "";

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

        if (!empty($_POST["ime"]))
        {
            $ime = test_input($_POST["ime"]);
        }

        if (!empty($_POST["prezime"]))
        {
            $prezime = test_input($_POST["prezime"]);
        }

        if(!isset($_POST["rpassword"]))
        {
            $userRPasswordErr = "Morate ponovo uneti password";
        }
        else 
        {
            $rpassword = test_input($_POST["rpassword"]);
        }
    }
    if(!empty($username) && !empty($password) && !empty($rpassword) && ($password == $rpassword) && !empty($ime) && !empty($prezime))
    {
        $sqlCheck = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = '$username'";
        $resultCheck = $conn->query($sqlCheck);

        if($resultCheck->num_rows > 0)
        {
            header('Location: ../signUP.php');
        }
        else
        {
            $sqlInsert = 'INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime, slika)
            VALUES("' . $username . '", "' . password_hash($password, PASSWORD_BCRYPT) . '", "' . $ime . '", "' . $prezime .'", "avatar.png" )';
            $conn->query($sqlInsert);
            $_SESSION["username"] = $username;
            header('Location: ../');
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // header('Location: ../');
    
?>
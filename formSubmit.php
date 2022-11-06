<?php 
include "./connection.php";
    $userErr = $userPasswordErr = $userRPasswordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["username"]))
        {
           $userErr = "Morate uneti username";
        }
        else
        {
            $_SESSION["user"] = test_input($_POST["username"]);
            $userErr = "";
        }

        if (empty($_POST["password"]))
        {
            $userPasswordErr = "Morate uneti password";
        }
        else
        {
            $_SESSION["userPassword"] = test_input($_POST["password"]);
            $userPasswordErr = "";
        }
        if(isset($_POST["rpassword"]) && empty($_POST["rpassword"]))
        {
            $userRPasswordErr = "Morate ponovo uneti password";
        }
        else if("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == "http://nemanaziv.com/login/signUP.php")
        {
            $rpassword = test_input($_POST["rpassword"]);
            if($rpassword == $password)
            {
                $userPasswordErr = "";
                $rpassword = "";
            }
            else
                $userRPasswordErr = "Morate ponovo uneti password";
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    
?>
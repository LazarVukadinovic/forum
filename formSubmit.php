<?php 
include "./connection.php";
    $userErr = $userPasswordErr = $userRPasswordErr = "";
    $ime = $prezime = "";

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
        else if("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == "http://nemanaziv.com/signUP.php")
        {
            $rpassword = test_input($_POST["rpassword"]);
            $ime = test_input($_POST["ime"]);
             $prezime = test_input($_POST["prezime"]);
            if($rpassword == $password)
            {
                $userPasswordErr = "";
                $rpassword = "";
            }
            else
                $userRPasswordErr = "Morate ponovo uneti password";

            
        }
        // if(!empty($_POST["ime"]) && !empty($_POST["prezime"]) && ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == "http://nemanaziv.com/login/signUP.php"))
        // {
            
        //     $ime = test_input($_POST["ime"]);
        //     $prezime = test_input($_POST["prezime"]);
        // }
        

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    
?>
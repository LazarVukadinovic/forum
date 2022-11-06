<?php
    session_start();
    include "./connection.php";

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pocetna strana</title>
        <style>
            .error {color: #FF0000;}
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <?php include "./formSubmit.php";?>
        <a href="./index.php" class="btn btn-primary" >Home</a>
        <a href="./index.php" class="btn btn-primary" >Prijavi se</a>
        <a href="./signUP.php" class="btn btn-primary">Registruj se</a>
        <div class="container">
            <h1 class="text-center mt-3">Login page</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="text-center mt-5">
                <label class="mt-2" for="username">Username: </label>  
                <input class="mt-1" type="email" name="username"> <span class="error">* <?php echo $userErr;?></span>
                <br>
                <label class="mt-2" for="password">Password: </label> 
                <input class="mt-1" type="password" name="password"> <span class="error">* <?php echo $userPasswordErr;?></span>
                <br>
                <input class="btn btn-primary mt-2" type="submit" value="LOGIN">
                            
            </form>
        </div>
        <?php 
            if(!empty($_SESSION["user"]) && !empty($_SESSION["userPassword"]))
            {
                $sql = "SELECT username, password FROM loginInfo WHERE username = '" . $_SESSION["user"] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
        
        
                if ($result->num_rows > 0) {
                    if($row["username"] == $_SESSION["user"] && password_verify($_SESSION["userPassword"], $row["password"]))
                    {
                        $_SESSION["loggedIn"] = 1;
                        header('Location: http://nemanaziv.com/login/index.php');
                    }
                    else
                        echo "<script>alert('Nema vaseg naloga');</script>";
                }
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
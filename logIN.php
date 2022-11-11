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
        <title>Login</title>
        <style>
            .btn-colorc{
                background-color: #0e1c36 !important;
                color: #fff !important;
                
            }
            .cardbody-color{
                background-color: #ebf2fa;
            }
            a{
                text-decoration: none;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <?php include "./handling/formSubmit.php";?>
        <?php include "./elements/navbar.php";?>
        <div class="container mt-5">
            <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">

                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="card-body cardbody-color p-lg-5">

                    <div class="text-center">
                        <h3>PRIJAVITE SE</h3>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Korisnicko ime">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Lozinka">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-colorc px-5 mb-4 w-100">Login</button>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-2 text-dark">
                        Nemate nalog? 
                        <a href="./signUP.php" class="text-dark fw-bold"> Napravi nalog</a>
                    </div>
                </form>
                </div>

            </div>
            </div>
        </div>
        <?php 
            if(!empty($_SESSION["user"]) && !empty($_SESSION["userPassword"]))
            {
                $sql = "SELECT korisnicko_ime, lozinka FROM korisnik WHERE korisnicko_ime = '" . $_SESSION["user"] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
        
        
                if ($result->num_rows > 0) {
                    if($row["korisnicko_ime"] == $_SESSION["user"] && password_verify($_SESSION["userPassword"], $row["lozinka"]))
                    {
                        $_SESSION["loggedIn"] = 1;
                        if(isset($_SESSION["idTeme"]) && !empty($_SESSION["idTeme"]))
                            header('Location: http://nemanaziv.com/diskusija.php?id=' . $_SESSION["idTeme"]); 
                        else
                            header("location:/index.php"); 
                    }
                    
                }
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
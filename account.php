<?php
    session_start();
    include "./connection.php";
    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    {
        header('Location: http://nemanaziv.com/index.php');
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pocetna strana</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <style>
            img {
                border: 2px solid black;
                border-radius: 50%;
                max-width: 200px;
            }
            p{
                font-size: 16px;
                font-weight: 600;
            }
            span{
                font-weight: 400;
            }
            input{
                max-width: 50%;
            }
            .btn-colorc{
                background-color: #0e1c36 !important;
                color: #fff !important;
                
            }
        </style>
    </head>
    <body>
        <?php include "./elements/navbar.php";?>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-5 mt-4">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png">
                </div>
                <div class="col-md-7">
                
                    <h2 class="mb-3">DETALJI NALOGA</h2>
                    <p>Korisnicko ime: <span><?php echo $_SESSION["user"]?></span></p>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                        <div class="mb-3">
                            <input type="password" class="form-control" name="spassword" placeholder="Stara lozinka">
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="npassword" placeholder="Nova lozinka">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="rpassword" placeholder="Ponovite novu lozinku">
                        </div>
                        <div class="text-center d-inline">
                            <button type="submit" class="btn btn-colorc px-5 mb-4">Promeni</button>
                        </div>
                    </form>
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            if (!empty($_POST["spassword"]))
                                $spassword = test_input($_POST["spassword"]);
                            if (!empty($_POST["npassword"]))
                                $npassword = test_input($_POST["npassword"]);
                            if (!empty($_POST["rpassword"]))
                                $rpassword = test_input($_POST["rpassword"]);
                        }
                        $sql = "SELECT korisnicko_ime, lozinka FROM korisnik WHERE korisnicko_ime='" . $_SESSION["user"] . "'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        if(isset($spassword) && isset($npassword) && isset($rpassword))
                        if((password_verify($spassword, $row["lozinka"]) && !empty($npassword) && !empty($rpassword)))
                        {
                            $sql = "UPDATE korisnik SET lozinka = '" . password_hash($npassword, PASSWORD_BCRYPT) . "' WHERE korisnicko_ime = '" . $_SESSION["user"] . "'";
                            $result = $conn->query($sql);
                        }


                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                    ?>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
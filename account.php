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
        <link rel="stylesheet" href="./styles/account.css">
    </head>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST["spassword"]))
                $spassword = test_input($_POST["spassword"]);
            if (!empty($_POST["npassword"]))
                $npassword = test_input($_POST["npassword"]);
            if (!empty($_POST["rpassword"]))
                $rpassword = test_input($_POST["rpassword"]);
        }
        $sql = "SELECT korisnicko_ime, lozinka, ime, prezime FROM korisnik WHERE korisnicko_ime='" . $_SESSION["user"] . "'";
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
    <body>
        <?php include "./elements/navbar.php";?>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3 mt-4">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-3">DETALJI NALOGA</h2>
                    <div class="row">
                        <div class="col-md-5">
                            <p>Korisnicko ime: <span><?php echo $_SESSION["user"]?></span></p>
                            <p>Ime: <span><?php echo $row["ime"]?></span></p>
                            <p>Prezime: <span><?php echo $row["prezime"]?></span></p>
                        </div>
                        <div class="col-md-7">
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
                                
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php 
               $sql = "SELECT id, naziv_teme, opis_teme, datum_kreiranja, kreator FROM tema WHERE kreator = '" . $_SESSION["user"] . "' ORDER BY datum_kreiranja DESC";
               $result = $conn->query($sql);
               

               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                       $sql_kreator = "SELECT ime, prezime FROM korisnik WHERE korisnicko_ime = '" . $row["kreator"] . "'";
                       $result_kreator = $conn->query($sql_kreator);
                       $podaci = $result_kreator->fetch_assoc();
                       echo '<div class="row">';
                           echo '<div class="col">';
                               echo "<div class='objava mt-2'>
                                   <a href='./diskusija.php?id=" . $row["id"] . "'><h5>" . $row["naziv_teme"] . "</h5>
                                   <p> ● " . $row["opis_teme"] . "</p></a>
                                   <small style='display:block; float:right'>" . $podaci["ime"] . " " . $podaci["prezime"] . " - " . date_format(date_create($row["datum_kreiranja"]), "d.m.Y H:i") . "</small>
                               </div>";
                           echo '</div>';
                       echo '</div>';
                  }
               } 
            ?>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
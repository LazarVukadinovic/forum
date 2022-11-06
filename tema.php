<?php 
    date_default_timezone_set('Europe/Belgrade');
    session_start();
    include "./connection.php";

    if(isset($_SESSION["loggedIn"])  && $_SESSION["loggedIn"] == 0)
    {
        header('Location: http://nemanaziv.com/login/index.php');
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Druga strana</title>
    </head>
    <body>
        <a href="./index.php" class="btn btn-primary" >Home</a>
        <div class="container">
            <h1 class="text-center mt-4">Kreiraj temu</h1>

            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="text-center mt-5"> 
                        <label class="mt-2" for="naziv">Naziv: </label>  
                        <input class="mt-1" type="text" name="naziv"> <span class="error">*</span>
                        <br>
                        <label class="mt-2" for="opis">Opis: </label> 
                        <input class="mt-1" type="text" name="opis"> <span class="error">* </span>
                        <br>
                        <input class="btn btn-primary mt-2" type="submit" value="Kreiraj">
                    </form>
                </div>
            </div>
        </div>

        <?php 
            $naziv = $opis = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST["naziv"])){
                    $naziv = test_input($_POST["naziv"]);
                }
                if (!empty($_POST["opis"])){
                    $opis = test_input($_POST["opis"]);
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(!empty($naziv) && !empty($opis)){
                $vreme = date("d.m.Y H:i");
                $sql = "INSERT INTO tema (nazivTeme, opisTeme, datumKreiranja)
                VALUES('" . $naziv . "', '" . $opis . "', '" . $vreme . "')";
                $conn->query($sql);
                $naziv = $opis = $vreme = "";
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
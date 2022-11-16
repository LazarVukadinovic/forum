<?php 
    date_default_timezone_set('Europe/Belgrade');
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Tema</title>
        <link rel="stylesheet" href="./styles/login-signin.css">
    </head>
    <body>
        <?php include "./elements/navbar.php";?>
        <div class="container mt-5">
            <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">

                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="card-body cardbody-color p-lg-5">

                    <div class="text-center">
                        <h3>KREIRAJ TEMU</h3>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="naziv" aria-describedby="emailHelp" placeholder="Naziv teme">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="opis" placeholder="Opis teme">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-colorc px-5 mb-4 w-100">Kreiraj</button>
                    </div>
                </form>
                </div>

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
                $datum = date("Y-m-d H:i");
                $sql = "INSERT INTO tema (naziv_teme, opis_teme, datum_kreiranja, kreator)
                VALUES('" . $naziv . "', '" . $opis . "', '" . $datum . "', '" . $_SESSION["user"] . "')";
                $conn->query($sql);
                $naziv = $opis = $vreme = "";
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
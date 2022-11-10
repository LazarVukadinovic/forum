<?php
    session_start();
    include "./connection.php";

    if(isset($_SESSION["loggedIn"]))
    {
        if($_SESSION["loggedIn"] == 0)
        {
            $_SESSION["user"] = "";
            $_SESSION["password"] = "";
        }
        
    }
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
            .objava{
                max-width: 100%;
                background-color: #ebf2fa;
                border: 2px solid black;
                border-radius: 5px;
                margin: auto;
                padding: 15px 20px 10px 20px;
            }
            .objava h5{
                display:inline-block;
            }
            .objava p{
                display:inline;
            }
            small{
                font-size: 10px;
                opacity: 0.8;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <?php include "./formSubmit.php";?>
        <?php include "./elements/navbar.php";?>
        <div class="container mt-3">
            <?php
                $sql = "SELECT naziv_teme, opis_teme, datum_kreiranja, kreator FROM tema ORDER BY datum_kreiranja DESC";
                $result = $conn->query($sql);
                

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $sql_kreator = "SELECT ime, prezime FROM korisnik WHERE korisnicko_ime = '" . $row["kreator"] . "'";
                        $result_kreator = $conn->query($sql_kreator);
                        $podaci = $result_kreator->fetch_assoc();
                        echo '<div class="row">';
                            echo '<div class="col">';
                                echo "<div class='objava mt-2'>
                                    <h5>" . $row["naziv_teme"] . "</h5>
                                    <p> ● " . $row["opis_teme"] . "</p>
                                    <small style='display:block; float:right'>" . $podaci["ime"] . " " . $podaci["prezime"] . " - " . $row["datum_kreiranja"] . "</small>
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
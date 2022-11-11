<?php 
    date_default_timezone_set('Europe/Belgrade');
    session_start();
    include "./connection.php";
    $_SESSION["idTeme"] = $_GET["id"];
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Diskusija</title>
        <style>
            .objava{
                width: 80%;
                background-color: #ebf2fa;
                border: 2px solid black;
                border-radius: 5px;
                padding: 15px 20px 10px 20px;
                display: inline-block;
            }
            .autor{
                font-size: 18px;
                margin-bottom: 0;
                font-weight: 600;
            }
            small{
                font-size: 14px;
                opacity: 0.8;
            }
            .txt{
                margin-bottom: 0;
            }
            img{
                max-width: 64px;
                margin-top: -60px;
                margin-right: 10px;
            }
            .btn-colorc{
                background-color: #0e1c36 !important;
                color: #fff !important;
                
            }
        </style>
        </head>
    <body>
        <?php include "./elements/navbar.php";?>

        <div class="container mt-4">
        <?php
                $sql = "SELECT id, naziv_teme, opis_teme, datum_kreiranja, kreator FROM tema WHERE id = " . $_SESSION["idTeme"];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo '<div class="row">
                            <div class="col">
                                <h2 class="text-center">' . $row["naziv_teme"] . '</h2>
                            </div>
                        </div>';
                        $sql_kreator = "SELECT ime, prezime FROM korisnik WHERE korisnicko_ime = '" . $row["kreator"] . "'";
                        $result_kreator = $conn->query($sql_kreator);
                        $podaci = $result_kreator->fetch_assoc();
                        echo '<div class="row mt-3">';
                            echo '<div class="col">';
                                echo '<img src="https://bootdey.com/img/Content/avatar/avatar7.png">';
                                echo '<div class="objava">
                                    <p class="autor">' . $podaci["ime"] . ' ' . $podaci["prezime"] . '</p>
                                    <small>' . date_format(date_create($row["datum_kreiranja"]), "d.m.Y H:i") . '</small>
                                    <p class="txt">' . $row["opis_teme"] . '</p>
                                </div>';
                            echo '</div>';
                        echo '</div>';
                   }
                }
            ?>

            <div class="row mt-5">
                <div class="col">
                    <h4 class="text-center">KOMENTARI</h4>
                </div>
            </div>
            <?php
                if(isset($_SESSION["user"]) && !empty($_SESSION["user"]))
                {
                    include "./elements/createComment.php";
                }
                else
                {
                    echo '<div class="row">';
                        echo '<div class="col">';
                            echo '<div class="form-text text-center mb-2 text-dark">
                                        Prijavite se da bi diskutovali o temi. 
                                        <a href="./logIN.php" class="text-dark fw-bold"> Prijavi se</a>
                                    </div>';
                        echo '</div>';
                    echo '</div>';
                }


                $sql = "SELECT id_tema, ime_kreatora, opis, datum FROM komentari WHERE id_tema = " . $_SESSION["idTeme"] . " ORDER BY datum DESC";
                $result = $conn->query($sql);
                

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $sql_kreator = "SELECT ime, prezime FROM korisnik WHERE korisnicko_ime = '" . $row["ime_kreatora"] . "'";
                        $result_kreator = $conn->query($sql_kreator);
                        $podaci = $result_kreator->fetch_assoc();
                        echo '<div class="row mb-1">';
                            echo '<div class="col">';
                                echo '<img src="https://bootdey.com/img/Content/avatar/avatar7.png">';
                                echo '<div class="objava">
                                <p class="autor">' . $podaci["ime"] . ' ' . $podaci["prezime"] . '</p>
                                <small>' . date_format(date_create($row["datum"]), "d.m.Y H:i") . '</small>
                                <p class="txt">' . $row["opis"] . '</p>
                                </div>';
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
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="../styles/account.css" rel="stylesheet">
    <title>Prikaz strana</title>
</head>
<body>
    <?php include "./elements/navbar.php";?>

    <div class="container">
        
        <?php 
            $sql = "SELECT id, naziv_teme, opis_teme, datum_kreiranja, kreator FROM tema WHERE kreator = '" . $_GET['user'] . "' ORDER BY datum_kreiranja DESC";
            $result = $conn->query($sql);

            $sql_kreator = "SELECT ime, prezime FROM korisnik WHERE korisnicko_ime = '" . $_GET['user'] . "'";
            $podaci = $conn->query($sql_kreator)->fetch_assoc();
            echo "<h2 class='text-center mt-4 mb-3'>Postovi korisnika: " . $podaci["ime"] . " " . $podaci["prezime"] . "</h2>";

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
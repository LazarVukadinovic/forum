<?php
    session_start();
    include "./connection.php";

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    {
        $_SESSION["user"] = "";
        $_SESSION["password"] = "";
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
                max-width: 500px;
                background-color: #f5f5f5;
                border: 2px solid black;
                border-radius: 5px;
                margin: auto;
                padding: 20px;
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
        <a href="./index.php" class="btn btn-primary" >Home</a>
        <?php 
            if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1)
            {
                echo '<a href="./tema.php" class="btn btn-primary">Napravi post</a>';
                echo '<a href="./index.php" class="btn btn-primary">Odjavi se</a>';
            }
            else
            {
                echo '<a href="./logIN.php" class="btn btn-primary" >Prijavi se</a>';
                echo '<a href="./signUP.php" class="btn btn-primary">Registruj se</a>';
            }
        ?>
        <div class="container">
            <div class="row">
                <h1 class="mt-3 text-center">Dobrodosli</h1>
                <div class="col">
                    <?php 

                        $sql = "SELECT nazivTeme, opisTeme, datumKreiranja FROM tema";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<div class='objava mt-2'>
                                    <h2>" . $row["nazivTeme"] . "</h2>
                                    <p> " . $row["opisTeme"] . "</p>
                                    <small>" . $row["datumKreiranja"] . "</small>
                                </div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        
    </body>
</html>
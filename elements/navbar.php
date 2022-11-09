<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="./index.php">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <?php 
          if(isset($_SESSION["user"]))
          {
            echo '<li class="nav-item">
            <a class="nav-link" href="../tema.php">Napravi temu</a>
          </li>';
          }
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu">
            <?php
              if(isset($_SESSION["user"]))
              {
                echo '<li><a class="dropdown-item" href="#">Nalog</a></li>';
                echo '<li><a class="dropdown-item" href="../logout.php">Odjava</a></li>';
              }
              else
              {
                echo '<li><a class="dropdown-item" href="./logIN.php">Prijavi se</a></li>';
                echo '<li><a class="dropdown-item" href="./signUP.php">Registruj se</a></li>';
              }
            ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
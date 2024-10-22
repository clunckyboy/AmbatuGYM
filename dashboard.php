<?php
  session_start();

  if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuGYM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    /* Background styling */
.bg-custom {
    background-image: url('./amba2.jpg');
    background-size: cover;
    background-position: center;
    min-height: 100vh; /* Set the height of the background area */
    position: relative;
}

/* Overlay that applies the blur effect */
.blur-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(20px); /* Apply blur to the background */
    z-index: 0; /* Push it to the back */
}

.rounded-custom{
    padding: 10px;
    border-radius: 15px;
}
/* Translucent card container */
.translucent-card {
    background: rgba(255, 255, 255, 0.6); /* Semi-transparent white background */
    border-radius: 15px; /* Optional: for rounded corners */
    position: relative;
    z-index: 1; /* Ensure it stays on top of the blur */
}
</style>
</head>
  <body>
      <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-dark border rounded bg-warning" href="#">AmbatuGYM</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-warning" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-warning" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <!-- <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul> -->
              </li>
              <!-- <li class="nav-item"> -->
                <!-- <a class="nav-link disabled text-light" aria-disabled="true">log out</a> -->
                
                <form action="dashboard.php" method="POST"><button type="submit" name="logout">Log out</button></form>
              <!-- </li> -->
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn-warning rounded" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      
      <h2>Selamat datang <?= $_SESSION["username"] ?> </h2>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

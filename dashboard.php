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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .navbar{
    --bs-navbar-padding-x: 1;
}

.username{
    color: #FF8800;
}

.navbar-nav{
    margin-right: 25px;
    
}

.container-fluid{
    background-color: #FF8800;
}

.logo img {
    width:50px;
    height: 50px;
    /* margin-top: 20px; */
}

.hero{
    display: flex;
}

.left-section, .right-section{
    width: 50%;
}

.right-section{
    padding-left: 30px;
    margin-left: 50px;
}

.container{
    width: 100%;
    display: flex;
    /* justify-content: center; */
}

.nav-item{
    font-weight: 500;
}


.video-card{
    background-color: #d9d9d9 ;
    width: 540px;
    height: 360px;
    margin-top: 20px;
    /* margin-left: 41px; */
    padding: 30px;
    justify-content: ;
    /* margin-left: 50px; */
    text-align: center;
    align-items: center;
    margin-bottom: 20px;
    border-radius: 10px;
}

.stats-card{
    display: flex;
    padding: 10px;
    background-color: #d9d9d9;
    max-width: 540px;
    border-radius: 10px;
    align-content: center;
    margin-bottom: 10px;
}

.community-section{
    height: 275px;
}

.wadah{
    height: 245px;
}



</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary my-navbar">
        <div class="container-fluid">
          <a class="navbar-brand logo" href="#"><img src="./images/ambatugym2.png" alt=""></a>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Exercise</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="">Community</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="dashboard.php"><button class="nav-link" type="submit" name="logout" style="color: red;">Logout</button></form>
                 </li>
            </ul>
          </div>
        </div>
      </nav>
    
    <div class="main-content">
        <div class="left-section">
            <h1>Welcome, <span class="username"><?= $_SESSION["username"] ?></span>!</h1>
            <div class="daily-training">
                <h3>Daily Training</h3>
                <div class="kartu">
                    <h4>Exercise 1</h4>
                </div>
                <div class="kartu">
                    <h4>Exercise 2</h4>
                </div>
                <div class="kartu">
                    <h4>Exercise 3</h4>
                </div>
            </div>    

            <div class="community-section">
                <h3>Community</h3>
                <div class="wadah">
                  <div class="isi">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia officiis minima nobis non necessitatibus animi vitae cum quod ullam. In vero quaerat sunt? Veniam, est aspernatur. Reprehenderit deserunt laborum quo?
                  </div>
                  <div class="isi">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia officiis minima nobis non necessitatibus animi vitae cum quod ullam. In vero quaerat sunt? Veniam, est aspernatur. Reprehenderit deserunt laborum quo?
                  </div>

                </div>
            </div>
        </div>



        <div class="right-section">
            
            <div class="video-card">
                <h4>Statistik</h4>
            </div>

            <div class="stats-card">
                <img style="width: 30px; margin-right: 5px;" src=".\images\icons8-fire-100.png" alt="">
                <h6 style="align-items: center; padding-top: 5px;">Calories Burned</h6>
            </div>

            <div class="stats-card">
                <img style="width: 30px; margin-right: 5px;" src=".\images\days.png" alt="">
                <h6 style="align-items: center; padding-top: 5px;">Days Streak</h6>
            </div>

            <div class="stats-card">
                <img style="width: 30px; margin-right: 5px;" src=".\images\check.png" alt="">
                <h6 style="align-items: center; padding-top: 5px;">Exercise Complete</h6>
            </div>

        </div>
    </div>    






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php
    include "./services/database.php";
    session_start();

    $login_message = "";

    if(isset($_POST["login"])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users 
         WHERE users_username='$username' AND users_password='$password'";
        
        $result = $db->query($sql);

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["users_username"];
            $_SESSION["is_login"] = true;

            header('location: dashboard.php');
        } else {
            $login_message = "Akun atau password salah";
        }
    }    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuGYM Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Background styling */
        .bg-custom {
            background-image: url('./images/amba2.jpg');
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

        i{
            color: red;
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-form bg-custom">
        <!-- Blurred overlay -->
        <div class="blur-overlay"></div> 

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <!-- Translucent card to hold form content -->
                    <div class="card translucent-card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h4 class="mt-1 mb-5 pb-1">Welcome to AmbatuGYM</h4>
                                    </div>
                                    <form action='index.php' method="POST">
                                        <!-- <p>Please login to your account</p> -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="form2Example11" class="form-control" placeholder="username" name="username"/>
                                            <label class="form-label" for="form2Example11">Username</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" placeholder="password" name="password"/>
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <i> <?= $login_message ?> </i>
                                            <button class="btn btn-primary btn-block fa-lg mb-3" type="submit" name="login">Login</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <button type="button" onclick ="location.href='register.php'" class="btn btn-outline-danger">Create new</button>
                                        </div>                                    
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex flex-column align-items-center rounded">
                                <img src="./images/amba2.jpg" alt="Perrel Brown" class="w-100 rounded-custom shadow">
                                <div class="text-black px-7 py-2 p-md-6 mx-md-4" style="font-weight: 400;">
                                    <p class="medium mb-0">Welcome to our comprehensive health and fitness monitoring site! Here, you can effortlessly track and manage various aspects of your well-being. Our platform offers a wide range of tools and resources designed to help you stay on top of your health and fitness goals.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

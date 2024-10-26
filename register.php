<?php
    include "./services/database.php";
    session_start();

    $register_message = ""; 
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        try{
            $sql = "INSERT INTO users (users_username, users_password)
            VALUES ('$username', '$password')";

            if($db->query($sql)){
                $register_message = "Daftar akun berhasil, silahkan login";
            } else {
                $register_message = "Daftar akun gagal, coba lagi";
            }
        } catch(mysqli_sql_exception){
            $register_message = "username sudah digunakan";
        }
        $db->close();

        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuGYM register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .h-100 {
            height: 100% !important;
        }
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
    <section class="h-100 bg-custom d-flex align-items-center justify-content-center">
        <!-- Blurred overlay -->
        <div class="blur-overlay"></div> 

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <!-- Translucent card to hold form content -->
                    <div class="card translucent-card rounded-3 text-black rounded-custom">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h2 class="mt-1 mb-5 pb-1">Register</h2> 
                                        <p>Make an account!</p>
                                    </div>
                                    <form action="register.php" method="POST">  
                                        <div data-mdb-input-init class="form-group mb-4">
                                            <input type="username" id="form2Example11" 
                                            class="form-control" placeholder="username" name="username"/>
                                            <label class="form-label" for="form2Example11">Username</label>
                                        </div>
                                        <!-- <div data-mdb-input-init class="form-group mb-4">
                                            <input type="email" id="form2Example11" class="form-control" 
                                            placeholder="Email Address or Phone Number" />
                                            <label class="form-label" for="form2Example11">Email or Number</label>
                                        </div> -->
                                        <div data-mdb-input-init class="form-group mb-4">
                                            <input type="password" id="form2Example22" class="form-control" 
                                            placeholder="password" name="password"/>
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <i> <?= $register_message ?> </i>
                                            <button class="btn btn-warning btn-block fa-lg mb-3" type="submit" 
                                            onclick="location.href='main_page.html'" name="register">Register</button>
                                        </div>
                                    </form>

                                    <a href="index.php">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

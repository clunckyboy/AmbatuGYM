<?php
    include "./database/config.php";
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
    <link rel="icon" type="image/x-icon" href="./ambatugym2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuLogin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
            body, html {
            height: 100%;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between; 
            width: 80%; 
            max-width: 600px;
        }

        .left-section {
            background-color: #FF8000;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .left-section h1 {
            font-size: 3rem;
            text-align: center;
        }
        .logo img {
            width: 250px;
            height: 250px;
            margin-top: 20px;
        }
        .right-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            width: 100%;
            max-width: 300px;
        }
        .btn-custom {
            background-color: #FF8000;
            color: white;
            transition: transform 0.1s ease-in-out, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
            text-align: center;
        }
        .btn-custom:hover {
            background-color: #FF8000;
            border: 1px solid black;
            transform: scale(1.02);
            box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.147);
        }

        .btn-custom:active {
            background-color: rgb(196, 59, 0);
            /* transform: scale(0.98); */
        }

        .form-control {
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
        }

        .form-control:focus {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.147);
            transform: scale(1.02);
        }
    </style>

</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 left-section">
                <div class="header-content">
                    <h1 class="m-2">Reach Your<br>Goals With</h1>
                    <div class="logo">
                        <img src="./images/ambatugym2.png" alt="AmbatuGYM Logo">
                    </div>
                </div>
            </div>

            <div class="col-md-6 right-section">
                <div class="form-container">
                    <h2 class="mb-4">Login</h2>
                    
                    <form  action="index.php" id="form-login" method="POST">
                        
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>

                        <p> <?= $login_message ?> </p>

                        <button type="submit" class="btn btn-custom w-100 mb-3" name="login">Masuk</button>
                    
                    </form>
                    <p class="text-center">
                        Belum punya akun? <a href="register.php" class="text-warning">buat akun</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</body>
</html>

<?php
session_start();

if (isset($_SESSION["admin_login"])) {
    header("location: admin.php");
    exit;
}

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit;
}

include "./database/config.php";

$login_message = "";

if (isset($_POST["login"])) {
    if ($_POST['username'] == "admin" && $_POST['password'] == "admin123") {
        $_SESSION["admin_login"] = true;
        header('location: admin.php');
        exit;
    }
}

if (isset($_POST["login"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {
        $_SESSION["admin_login"] = true;
        header('location: admin.php');
        exit;
    }

    $sql = "SELECT * FROM users 
         WHERE username ='$username' AND password ='$password'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["user"] = $data;
        $_SESSION["is_login"] = true;

        header('location: dashboard.php');
        exit;

    } else {
        $login_message = "Incorrect account or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> AmbatuGYM Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Add a fade-in animation to the entire body */
        /* Scale and fade-in effect for the body */
        body,
        html {
            height: 100%;
            font-family: "Lexend", sans-serif;
            overflow: hidden;
            opacity: 1;
            /* Start invisible */
            transform: scale(1);
            /* Start slightly smaller */
            animation: scaleFadeIn 0.4s ease-out forwards;
            /* Apply combined animation */
        }

        /* Keyframes for scale and fade */
        @keyframes scaleFadeIn {
            from {
                transform: scale(1.03);
                /* Start small */
            }

            to {
                transform: scale(1);
                /* Grow to normal size */
            }
        }


        /* Your existing styles remain unchanged */

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 80%;
            max-width: 600px;
        }

        .left-section {
            background-color: #302019;
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
            width: 100%;
            height: 100%;
            margin-top: 20px;
        }

        .right-section {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0.5)), url(./images/bg.jpg);
        }

        .form-container {
            width: 100%;
            max-width: 300px;
        }

        .btn-custom {
            background-color: #613a2a;
            color: white;
            transition: transform 0.1s ease-in-out, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
            text-align: center;
        }

        .btn-custom:hover {
            background-color: #613a2a;
            transform: scale(1.02);
            box-shadow: 1px 1px 20px white;
        }

        .btn-custom:active {
            background-color: rgb(196, 59, 0);
        }

        .form-control {
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
        }

        .form-control:focus {
            box-shadow: 0px 0px 20px white;
            transform: scale(1.02);
            border: 1px solid black;
        }

        @media (max-width: 768px) {
            .header-content {
                align-items: center;
            }

            .left-section h1 {
                font-size: 2rem;
            }

            .logo {
                width: 30%;
            }
        }

        @media (max-width: 576px) {

            .left-section,
            .right-section {
                padding: 10px;
            }

            .left-section h1 {
                font-size: 1.8rem;
            }

            .form-container {
                width: 100%;
            }
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
                        <img src="./images/ambatugymwhite.png" alt="AmbatuGYM Logo">
                    </div>
                </div>
            </div>

            <div class="col-md-6 right-section">
                <div class="form-container">
                    <h2 class="mb-4">Login</h2>

                    <form action="" id="form-login" method="POST">

                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>

                        <p style="color: red;"> <?= $login_message ?> </p>

                        <button type="submit" class="btn btn-custom w-100 mb-3" name="login">Login</button>

                    </form>
                    <p class="text-center">
                        don't have an account yet? <a href="register.php">sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
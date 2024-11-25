<?php
    
session_start();

if ( !isset($_SESSION["is_login"]) ){
    header("location: login.php");
    exit;
}

include "./database/config.php";


function query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

if (isset($_POST['submit'])){
    global $db;
    $id = $_POST["id"];
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $goal = htmlspecialchars($_POST['goal']);
    $gambarLama = $_POST['gambarLama'];

    // cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = (function(){
            $namaFile = htmlspecialchars($_FILES['gambar']['name']);
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];
    
            $valid_ext = ['jpg', 'jpeg', 'png'];
            $ekstensi_gambar = explode('.', $namaFile);
            $ekstensi_gambar = strtolower(end($ekstensi_gambar));

            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensi_gambar;
            
            move_uploaded_file($tmpName, './user_pp/'.$namaFileBaru);
            
            return $namaFileBaru;
            
        }) ();
    }

    $query = "UPDATE users SET 
                username = '$username',
                email = '$email',
                password = '$password',
                goal = '$goal',
                profile_photo = '$gambar'
                WHERE user_id = $id  
            ";
}

$user = $_SESSION["user"];
$photo = $_SESSION["user"]["profile_photo"];



//query data berdasarkan id user

// $user = query("SELECT * FROM users WHERE user_id = $id")[0];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="icon" type="image/x-icon" href="./ambatugymwhite.png">
    <link rel="stylesheet" href="./Styles/profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        body {
        background: 
        linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0.5)), 
        url('./images/bg.jpg');
        background-size: cover;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        }


        .dark-mode {
            background: 
            linear-gradient(rgb(255, 255, 255), rgba(255, 255, 255, 0.5)), 
            url('./images/bg.jpg');
            background-size: cover;
            background-attachment: fixed;
        }

        .profile-card {
            margin-top: 75px;
            height: 490px;
            display: flex;
            /* flex-direction: row; */
            align-items: center;
            background-color:rgb(48, 32, 25);
            border-radius: 20px;
            padding: 10px 40px 0px 20px; /* Increased padding for extra height */
            max-width: 1000px; /* Wider width */
            width: 90%; /* Responsive width */
            min-height: 300px; /* Set a minimum height */
            box-shadow: 0px 10px 20px black;
            color: white;
            transition: background-color 0.2s ease-in-out;
        }

        .dark-mode .profile-card {
            background-color: rgb(255, 241, 224);
            color: black;
        }

        .profile-pic-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 20%;
            margin-right: 30px;
        }

        .dark-mode .change-pic {
            color: black;
        }

        .profile-pic-placeholder {
            width: 150px; /* Set a fixed width */
            height: 150px; /* Set a fixed height */
            border-radius: 50%; /* Makes the image circular */
            overflow: hidden; /* Ensures the image stays within the circular border */
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Keeps the image aspect ratio */
        }

        .change-pic {
            display: flex;
            align-items: center;
            color: white;
            font-size: 0.9em;
            cursor: pointer;
            text-decoration: underline;
        }
        .profile-info {
            text-align: center;
            flex: 1;
        }
        .profile-info h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: left;
        }
        .info-item {
            padding: 20px;
            border-radius: 10px;
            background-color: rgb(97, 58, 42);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.2s ease-in-out;
            margin: 10px 0;
        }

        .dark-mode .info-item {
            background-color:  rgb(255, 225, 181);
        }

        .info-label {
            flex: 1;
            font-weight: bold;
            color: #ddd;
            text-align: left;
        }
        .info-placeholder {
            flex: 2;
            color: #f0f0f0;
            text-align: left;
            padding-left: 10px;
        }

        .dark-mode .info-placeholder, .dark-mode .info-label, .dark-mode .edit-icon{
            color: black;
        }

        .edit-icon {
            font-family: "Material Symbols Outlined";
            font-size: 18px;
            cursor: pointer;
            color: #ddd; /* Adjust color as desired */
            padding-left: 10px;
        }

        .submit{
            padding: 12px;
            background: rgb(97, 58, 42);
            border: none;
            border-radius: 5px;
            color: white;
            font: inherit;
            justify-content: center;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .submit:hover{
            scale: 1.05;
            border: solid 1px white;
        }
        
    </style>
</head>

<body>
    <nav class="navbar navbar-logged-in">
        <img src="./images/ambatugymwhite.png" 
             data-light="./images/ambatugymwhite.png" 
             data-dark="./images/ambatugym2.png" 
             alt="ambatuLOGO">
        <div class="navbar-brand">
            <h2>AmbatuGYM</h2>
            <button onclick="myFunction()" class="btn-toggle">
                <span class="material-symbols-outlined">brightness_4</span>
            </button>
        </div>
        <div class="navbar-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="exercise.html">Exercises</a>
            <a href="community.html">Community</a>
            <div class="profile-container" style="position: relative;"> <!-- Ensure the container is relatively positioned -->
                <img id="profilePic" src="./user_pp/<?= $photo; ?> " alt="Profile Picture" class="profile-pic-small">
                <div id="profileTooltip" class="profile-tooltip" style="display: none;"> <!-- Keep tooltip hidden by default -->
                    <a href="" class="profile-button" onclick="Profile()">Profile</a>
                    <a href="./logic/logout.php" class="logout-button" onclick="logout()">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="profile-card">
        <div class="profile-pic-section">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" value="<?= $user["user_id"]; ?>">
                <input type="hidden" name="gambarLama" value="<?= $photo ?>">
                <div class="profile-pic-placeholder">
                    <img src="./user_pp/<?= $photo; ?>" alt="Profile Picture">
                </div>
                <input type="file" name="gambar" class="gambar" accept=".jpg, .jpeg, .png">
        </div>
        <div class="profile-info">
            <h2>Profile Information</h2>

                <div class="info-item">
                    <span class="info-label">E-mail</span>
                    <input type="text" name="email" id="email" required value="<?= $user["email"] ?>">
                    <!-- <span class="info-placeholder">example@example.com</span> -->
                    <span class="edit-icon material-symbols-outlined">edit</span>
                </div>
        
                <div class="info-item">
                    <span class="info-label">Username</span>
                    <input type="text" name="username" id="username" required value="<?= $user["username"] ?>">
                    <!-- <span class="info-placeholder">username123</span> -->
                    <span class="edit-icon material-symbols-outlined">edit</span>
                </div>
        
                <div class="info-item">
                    <span class="info-label">Password</span>
                    <input type="password" name="password" id="password" required value="<?= $user["password"] ?>">
                    <!-- <span class="info-placeholder">••••••••</span> -->
                    <span class="edit-icon material-symbols-outlined">edit</span>
                </div>
        
                <div class="info-item">
                    <span class="info-label">Badge</span>
                    <input type="text" name="badge" id="badge" required value="<?= $user["badge"] ?>">
                    <!-- <span class="info-placeholder">🏅 Placeholder Badge</span> -->
                    <span class="edit-icon material-symbols-outlined">edit</span>
                </div>
        
                <div class="info-item">
                    <span class="info-label" id="objective-label">Objective</span>
                    <span class="info-placeholder" id="objective-placeholder">Select an objective</span>
                    <span class="edit-icon material-symbols-outlined" id="toggle-options">expand_more</span>
                    <div class="toggle-list" id="toggle-list">
                        <div class="toggle-option" data-value="Building muscles">Building Muscles</div>
                        <div class="toggle-option" data-value="Losing weight">Losing Weight</div>
                        <div class="toggle-option" data-value="Maintain stamina">Maintain Stamina</div>
                    </div>                    
                </div>

                <button class="submit" name="submit" type="submit">Submit</button>

            </form>    
        </div>
    </div>
    <script src="./scripts/profile.js"></script>
</body>
</html>

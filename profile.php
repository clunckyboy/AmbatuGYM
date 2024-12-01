<?php
    
session_start();

if ( !isset($_SESSION["is_login"]) ){
    header("location: login.php");
    exit;
}

include "./database/config.php";

$user = $_SESSION["user"];
$photo = $_SESSION["user"]["profile_photo"];
$goals = $_SESSION["user"]["goal"];
$username = $_SESSION["user"]["username"];
$register_message = "";

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
    $id = $_SESSION["user"]["user_id"];
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

    if ($db->query($query) === TRUE) {
        $_SESSION["user"]["email"] = $email;
        $_SESSION["user"]["profile_photo"] = $gambar;
        $_SESSION["user"]["goal"] = $goal; 
        $_SESSION["user"]["username"] = $username;
        $register_message = "Profile changed successfully";

    } else {
        $register_message = "Error: " . $db->error;
    }

    $user = $_SESSION["user"];
    $photo = $_SESSION["user"]["profile_photo"];
    $goals = $_SESSION["user"]["goal"];
    $username = $_SESSION["user"]["username"];

}
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
    <link rel="stylesheet" href="./styles/profile.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/community.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        body {
            background: linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0.5)), url('./images/bg.jpg');
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        @media (max-width: 600px) {
            
            
            .navbar-links {
                display: none;
            }

            .profile-card {
                display: block;

            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="./images/ambatugymwhite.png" data-light="./images/ambatugymwhite.png" data-dark="./images/ambatugym2.png" alt="ambatuLOGO">
        <div class="navbar-brand">
            <h2>AmbatuGYM</h2>
            <button onclick="myFunction()" class="btn-toggle">
                <span class="material-symbols-outlined">
                    brightness_4
                </span>
            </button>
        </div>
        <button class="navbar-toggle" onclick="openNav()">☰</button> <!-- Hamburger icon -->
        <div class="navbar-links" id="navbarLinks">
            <a href="dashboard.php">Dashboard</a>
            <a href="exercise.php">Exercises</a>
            <a href="community.php">Community</a>
            <div class="profile-container">
                <img src="./user_pp/<?= $_SESSION['user']['profile_photo'] ?>" alt="Profile Picture" class="profile-pic-small" onclick="toggleDropdown()">
                <div id="dropdown" class="dropdown-content">
                    <a href="./profile.php">Profile</a>
                    <a href="./logic/logout.php" id="logout">Logout</a>
                </div>
            </div>
        </div>    
    </nav>
        
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="exercise.php">Exercises</a>
        <a href="community.php">Community</a>
        <a href="./logic/logout.php" class="btn-custom" onclick="logout()">Logout</a>
    </div>

    <div class="profile-card">
        <div class="profile-pic-section">
            <form action="profile.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" value="<?= $user["user_id"]; ?>">
                <input type="hidden" name="gambarLama" value="<?= $photo ?>">
                <div class="profile-pic-placeholder">
                    <img src="./user_pp/<?= $photo; ?>" alt="Profile Picture">
                </div>
                <input type="file" name="gambar" class="gambar" accept=".jpg, .jpeg, .png">
        </div>
        <div class="profile-info">
            <h2>Profile Information</h2>
            <p style="color: green;"><?= $register_message ?></p>

                <div class="info-item">
                    <span class="info-label">E-mail</span>
                    <input type="email" name="email" id="email" required value="<?= $user["email"] ?>">
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
                    <input  type="password" name="password" id="password" required value="<?= $user["password"] ?>">
                    <!-- <span class="info-placeholder">••••••••</span> -->
                    <span class="edit-icon material-symbols-outlined">edit</span>
                </div>
        
                <div class="info-item">
                    <span class="info-label" id="objective-label">Goal</span>
                    <!-- <span class="info-placeholder" id="objective-placeholder">Select an objective</span> -->
                    <!-- <span class="edit-icon material-symbols-outlined" id="toggle-options">expand_more</span> -->
                    <select name="goal" class="form-select" aria-label="Default select example" required>
                        <option value="" disabled <?= $goals == '' ? 'selected' : ''; ?>>Choose a goal</option>
                        <option value="lose_weight" <?= $goals == 'lose_weight' ? 'selected' : ''; ?>>Lose Weight</option>
                        <option value="build_muscle" <?= $goals == 'build_muscle' ? 'selected' : ''; ?>>Build Muscle</option>
                        <option value="maintain" <?= $goals == 'maintain' ? 'selected' : ''; ?>>Maintain</option>
                    </select>              
                    <span class="edit-icon material-symbols-outlined">edit</span>

                </div>

                <button class="submit" name="submit" type="submit" onclick="confirm('You Sure ?')">Change</button>

            </form>    
        </div>
    </div>

    <script>
        //Function Dropdown Profil
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("show");
        }
        
        window.onclick = function(event) {
            if (!event.target.matches('.profile-pic-small')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <script src="./scripts/about.js"></script>
    <script src="./scripts/profile.js"></script>
</body>
</html>

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
    <link rel="stylesheet" href="./Styles/profile.css">
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


        .dark-mode {
            background: 
            linear-gradient(rgb(255, 255, 255), rgba(255, 255, 255, 0.5)), 
            url('./images/bg.jpg');
            background-size: cover;
            background-attachment: fixed;
        }

        .profile-card {
            /* padding-left: 2px; */
            margin-top: 75px;
            height: 490px;
            display: flex;
            /* flex-direction: row; */
            align-items: center;
            background-color:rgb(48, 32, 25);
            border-radius: 20px;
            padding: 10px 40px 0px 20px; /* Increased padding for extra height */
            /* max-width: 1000px; */
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
            margin-right: 20px;
            margin-left: 20px;
            /* width: 20%; */


            /* margin-right: 30px; */
        }

        .dark-mode .change-pic {
            color: black;
        }

        .profile-pic-placeholder {
            width: 200px; /* Set a fixed width */
            height: 200px; /* Set a fixed height */
            border-radius: 50%; /* Makes the image circular */
            overflow: hidden; /* Ensures the image stays within the circular border */
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .profile-pic-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        .gambar {
            /* Sembunyikan teks bawaan "No file chosen" */
            /* color: transparent;  */
            display: block;
            width: 95px;
            justify-self: center;
            /* justify-content: center; */
        }

        .gambar::file-selector-button {
            /* Kustomisasi tombol "Choose File" */
            display: block;
            margin-bottom: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 5px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            font-family: "Lexend";
            left: 30px;
        }

        .gambar::file-selector-button:hover {
            background-color: #0056b3;
        }

        /* Atur ulang ukuran elemen input agar tombol sesuai */
        /* .gambar {
            width: fit-content;
            padding: 0;
            border: none;
        } */

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
            padding: 10px 20px;
            border-radius: 10px;
            background-color: rgb(97, 58, 42);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.2s ease-in-out;
            margin: 10px 0;
        }

        .info-item input{
            font-family: inherit;
            font-size: large;
            padding: 10px;
            border-radius: 5px;
            border: 2px solid rgb(97, 58, 42);;
            background-color: rgb(97, 58, 42);
            color: white;
        }

        .dark-mode .info-item {
            background-color:  rgb(255, 225, 181);
        }

        .info-label {
            /* flex: 1; */
            width: 77.57px;
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

        .form-select{
            font-family: inherit;
            font-size: large;
            padding: 10px;
            border-radius: 5px;
            border: 2px solid rgb(97, 58, 42);;
            background-color: rgb(97, 58, 42);
            color: white;
            width: 245.33px;
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
            <a href="exercise.php">Exercises</a>
            <a href="community.php">Community</a>
            <div class="profile-container" > <!-- Ensure the container is relatively positioned -->
                <img id="profilePic" src="./user_pp/<?= $photo; ?> " onclick="toggleDropdown()" class="profile-pic-small">
                <div id="dropdown" class="dropdown-content">
                    <a href="./profile.php">Profil</a>
                    <a href="./logic/logout.php" id="logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
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
    <script src="./scripts/profile.js"></script>
</body>
</html>

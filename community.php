<?php
    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    require "./database/config.php";
     
    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    $komen = query("SELECT
                        community.post_id AS id,
                        users.profile_photo AS foto,
                        users.username AS username, 
                        community.content AS komentar, 
                        DATE_FORMAT(community.post_date, '%m/%d %H:%i:%s') AS tanggal, 
                        community.likes_count AS likes
                    FROM community, users 
                    WHERE users.user_id = community.user_id  
                    ORDER BY community.post_date DESC");


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=brightness_4"/>
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <link rel="stylesheet" href="./styles/community.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>

    <style>
        body {
            background: 
            linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0.5)), 
            url('./images/bg.jpg');
            background-attachment: fixed;
            background-size: cover;
        }

        .dark-mode {
            background: 
                linear-gradient(rgb(255, 255, 255), rgba(255, 255, 255, 0.5)), 
                url('./images/bg.jpg');
        }

        .dropdown-content {
            display: none;
            position: fixed;
            right: 10px;
            top: 70px;
            background-color: #302019;
            min-width: 90px;
            border-radius: 5px;
            z-index: 100;
        }

        .dropdown-content a {
            text-align: center;
            color: white;
            padding: 12px;
            text-decoration: none;
            display: block;
        }


        .dropdown-content a:hover {
            background-color: #613a2a;
        }

        .show {
            display: block;
        }





        /* COMMUNITY CARD */



        .container{
            margin-bottom: 20px;
            margin-top: 90px;
            margin-right : 20px;
            margin-left : 20px;
            padding-top: 0;
            height: 480px;
            align-items: center;
        }

        .comment-box {
            background-color: rgb(97, 58, 42);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            width: 95%;
            height: fit-content;
            /* width: 100%; */
        }
    
        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* gap: 10px; */
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    
        .comment-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .profile{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile p{
            margin: 0;
            text-align: center;
            font-weight: bold;
        }
    
        .comment-content {
            font-size: 0.9em;
            color: #ffffff;
            font-weight: 200;
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }
    
        .comment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 0.8em;
            color: #ffffffad;
        }
    
        .like-count {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 15px;
        }

        .dark-mode .like-count {
            color: rgba(0, 0, 0, 0.764);
        }
    
        .comment-form-section textarea {
            width: 90%;
            height: 150px;
            border-radius: 10px;
            border: 1px solid rgb(97, 58, 42);
            padding: 10px;
            font-size: 15px;
            margin-bottom: 10px;
            background-color: black;
            color: white;
            transition: transform 0.2s;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0);
            resize: none;
        }
        .comment-form-section textarea:focus{
            transform: scale(1.03);
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.524);
        }

        .comments-section, .comment-form-section {
            border-radius: 10px;
        }
    
        .comments-section {
            padding: 20px;
            width: 75%;
            padding-right: 20px;
            border-radius: 10px;
            overflow-y: scroll;
            /* height: 550px; */
            /* height: 300px; */
            height: 87%
            /* overflow-x: hidden; */
        }
    
        .comment-form-section {
            /* flex: 1; */
            margin: 0 auto;
            padding: 20px;
            width: 30%;
            /* height: 87%;  */
        }

        .dark-mode .comment-box, .dark-mode .comment-content {
            background-color: rgb(255, 225, 181); /* Light card background */
            color: rgb(0, 0, 0);
        }

        .dark-mode .comment-form-section textarea {
            color: black;
            font-family: "Lexend", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            background-color: rgb(255, 225, 181);
            border: 1px solid rgb(97, 58, 42);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0);
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .dark-mode .comment-form-section textarea:focus {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.483);
        }

        /* Scrollbar customization */
        .comments-section::-webkit-scrollbar {
            width: 10px; /* Width of the scrollbar */
        }

        .comments-section::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.397); 
            border-radius: 10px;
        }

        .comments-section::-webkit-scrollbar-thumb {
            background-color: rgba(97, 58, 42, 0.8); 
            border-radius: 10px;
        }

        .comments-section::-webkit-scrollbar-thumb:hover {
            background-color: rgba(97, 58, 42, 1); /* Scrollbar color on hover */
        }

        .thumb-up {
            border-radius: 10px;
            border: 0;
            background-color: rgb(48, 32, 25);
            padding: 4px;
            transition: background-color 0.2s, transform 0.2s;
        }
        .dark-mode .thumb-up {
            background-color: rgb(255, 241, 224);
        }
        .thumb-up:hover {
            background-color:rgb(122, 85, 69);
            transform: scale(1.04)\;
        }
        .thumb-up:active {
            background-color: rgb(0, 0, 0);
            transform: scale(0.96);
        }

    </style>
</head>
<body>
    <nav class="navbar">
        <img src="./images/ambatugymwhite.png" 
        data-light="./images/ambatugymwhite.png" 
        data-dark="./images/ambatugym2.png" 
        alt="ambatuLOGO">
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
                <a href="#community">Community</a>
                <div class="profile-container">
                    <img src="./user_pp/<?= $_SESSION['user']['profile_photo'] ?>" alt="Profile Picture" class="profile-pic-small" onclick="toggleDropdown()">
                    <div id="dropdown" class="dropdown-content">
                        <a href="./profile.php">Profil</a>
                        <a href="./logic/logout.php" id="logout">Logout</a>
                    </div>
                </div>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="exercise.php">Exercises</a>
                <a href="#community">Community</a>
                <a href="./logic/logout.php" class="btn-custom" onclick="logout()">Logout</a>
              </div>
    </nav>
    
    <div class="parent" id="community">
        <div class="container">
            
            <div class="comments-section">
                <h1>Community</h1>

                <?php foreach ($komen as $comment): ?>
                <div class="comment-box">
                    <div class="comment-header">
                        <div class="profile">                        
                            <img src="./user_pp/<?= $comment["foto"]; ?>" alt="User Icon">
                            <p><?= $comment["username"]; ?></p>
                        </div>
                        <p><?= $comment["tanggal"]; ?></p>
                    </div>
                    <div class="comment-content">
                        <?= $comment["komentar"]; ?>
                    </div>
                    <div class="comment-footer">
                        <span class="like-count"> <?= $comment["likes"] ?>
                            <a href="./logic/like.php?id=<?= $comment["id"] ?>">
                                <button class="thumb-up" onclick="liked()"> 
                                    <span>
                                    👍
                                    </span>
                                </button>
                            </a>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        

            <div class="comment-form-section">
                    <h1>Add a Comment !</h1>
                    <form action="./logic/comment.php" method="POST" autocomplete="off">
                        <textarea id="commentInput" name="comment" class="form" placeholder="Say something!" rows="10" cols="50" maxlength="700" required></textarea>
                        <button type="submit" name="submit" class="btn-custom">Post!</button>
                    </form>

            </div>
        </div>

    <script src="./scripts/about.js"></script>
    <script src="./scripts/comment.js"></script>
</body>
</html>


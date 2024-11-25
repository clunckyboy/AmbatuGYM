<?php
    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    include "./database/config.php";
    
    $data = [];
    $url = [];

    $goal = $_SESSION["user"]["goal"];
    $username = $_SESSION["user"]["username"];
    $photo = $_SESSION["user"]["profile_photo"];

    $result = $db->query("SELECT DISTINCT video_url FROM exercises WHERE '$goal' = exercises.goal ORDER BY RAND() LIMIT 3");

    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Mengisi array dengan setiap hasil
    }

    // Mengambil video_url dari setiap data yang diambil
    foreach ($data as $item) {
        $url[] = $item['video_url'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <title>Dashboard</title>
</head>

<body >
    <nav class="navbar" id="top">
        <a class="img" href="#top"><img src="./images/ambatugymwhite.png" alt=""></a>
        <div class="brand-text">
            <h2>AmbatuGYM</h2>
            <!-- <p>Fitness and Health Tracker</p> -->
        </div>
        <ul class="navbar-item">
            <li class="nav-list">
                <a class="nav-link" href="#dashboard">Dashboard</a>
            </li>
            <li class="nav-list">
                <a class="nav-link" href="exercise.html">Exercises</a>
            </li>
            <li class="nav-list">
                <a class="nav-link" href="community.html">Community</a>
            </li>
            <li class="nav-list">
                <img src="./user_pp/<?= $photo ?> " alt="Profile" onclick="toggleDropdown()" class="profile-pic">
                <div id="dropdown" class="dropdown-content">
                    <a href="./profile.php">Profil</a>
                    <a href="./logic/logout.php" id="logout">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <main>
        <div class="left-section">
            <div class="welcome" id="dashboard">
                <h1>Welcome, <span><?= $username ?></span>!</h1>
            </div>
            <div class="daily-training card">
                <h2>Daily Training</h2>
                <div class="trainings">

                    <button class="training-card">
                        <div class="training-image">
                            <img src="./latihan/<?=$url[0]?>">
                        </div>
                        <div class="check-section">
                            <h3>nama latihan</h3>
                            <input type="checkbox" class="check-box">
                        </div>
                    </button>

                    <button class="training-card">
                        <div class="training-image">
                            <img src="./latihan/<?=$url[1]?>" alt="">
                        </div>
                        <div class="check-section">
                            <h3>nama latihan</h3>
                            <input type="checkbox" class="check-box">
                        </div>
                    </button>

                    <button class="training-card">
                        <div class="training-image">
                            <img src="./latihan/<?=$url[2]?>" alt="">
                        </div>
                        <div class="check-section">
                            <h3>nama latihan</h3>
                            <input type="checkbox" class="check-box">
                        </div>
                    </button>
                </div>
            </div> 

            <div class="popup" id="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h2>Nama Latihan</h2>
                    <img src="./latihan/<?=$url[2]?>" alt="">
                    <p>Ini adalah konten pop-up yang sama untuk semua elemen.</p>
                    </div>
            </div>
            
            <div class="community">
                <div class="community-card">
                    <h2 style="margin-bottom: 20px;">Community</h2>
                    <div class="comment-card">
                        <div class="left-comment">
                            <img src="./images/profilepics/edwin.jpg" alt="">
                        </div>
                        <div class="right-comment">
                            <div class="container-info">
                                <p></p>
                                <p>11/11/2024</p>
                            </div>
                            <p class="content">Very nice website, looking forward to using it Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores recusandae repellendus quo dolor minus, deserunt voluptatibus eos ab iure sed. Sint ipsum placeat laudantium facere aliquam aut sit, quaerat quisquam sapiente accusantium officiis debitis optio assumenda, facilis, odit itaque? Dolore similique, ipsum nemo necessitatibus labore hic nobis adipisci fugiat assumenda, ipsa optio minus saepe dicta. Adipisci vel quae dolor esse nisi cumque fugit quos. Id ex illum, harum, culpa sunt alias quos ipsam rerum ut temporibus voluptates, vel recusandae debitis soluta! Expedita quod ducimus labore? Numquam quos enim quo fugiat. Delectus, commodi ea! Consequatur, earum distinctio quae reprehenderit blanditiis soluta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-section">
            <div class="statistic">    
                <div class="statistic-card">
                    <h2 style="padding-left: 20px;">Your Statistic</h2>
                    <!-- <div class="statistic-diagram">
                    </div> -->
                    <div class="mini-stat">
                        <div class="stat-card">
                            <h3>Exercise Completed</h3>
                            <div class="value">
                                <img src="./images/check.png" height="50px" width="50px" alt="exercise completed">
                                <h2>5</h2>
                            </div>
                        </div>

                        <div class="stat-card">
                            <h3>Days Streak</h3>
                            <div class="value">
                                <img src="./images/days.png" height="50px" width="50px" alt="exercise completed">
                                <h2>5</h2>
                            </div>
                        </div>

                        <div class="stat-card">
                            <h3>Calories Burned</h3>
                            <div class="value">
                                <img src="./images/icons8-fire-100.png" height="50px" width="50px" alt="exercise completed">
                                <h2>125 <span>cal</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        //Function Dropdown Profil
        function toggleDropdown() {
        document.getElementById("dropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-pic')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                        }
                }
            }
        }

        //function untuk pop up daily training
        function openPopup() {
        document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
        document.getElementById('popup').style.display = 'none';
        }

        document.querySelectorAll('.training-card').forEach(item => {
        item.addEventListener('click', openPopup);
        });



    </script>

</body>

</html>
<?php
    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    include "./database/config.php";
    
    $current_date = date("Y-m-d");
    $last_update = $_SESSION["last_update"] ?? null;
    
    if ($last_update !== $current_date) {
        // Ambil data latihan acak sesuai goal
        $goal = $_SESSION["user"]["goal"];
        $result = $db->query("SELECT * FROM exercises 
                            WHERE goal = '$goal' 
                            GROUP BY exercise_name 
                            ORDER BY RAND() LIMIT 3");
    
        // Simpan data latihan ke dalam sesi
        while ($row = $result->fetch_assoc()) {
            $exercise[] = $row;
        }
    
        $_SESSION["daily_training"] = $exercise; // Simpan ke sesi
        $_SESSION["last_update"] = $current_date; // Perbarui waktu terakhir update
    } else {
        // Ambil data latihan dari sesi jika sudah ada
        $exercise = $_SESSION["daily_training"];
    }
    
    $username = $_SESSION["user"]["username"];
    $photo = $_SESSION["user"]["profile_photo"];
    $complete = $_SESSION["user"]["exercise_complete"];
    $daystreak = $_SESSION["user"]["day_streak"];
    $calorie = $_SESSION["user"]["calories_burn"];
    $comment = [];

    // MENGAMBIL DATA COMMUNITY
    $result = $db->query("SELECT users.profile_photo AS foto,
                                users.username AS username, 
                                community.content AS komentar, 
                                DATE_FORMAT(community.post_date, '%m/%d %H:%i:%s') AS tanggal 
                                FROM community, users 
                                WHERE users.user_id = community.user_id  
                                ORDER BY community.post_date DESC LIMIT 5");

    while ($row = $result->fetch_assoc()){
        $comment[] = $row; 
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

<body>
    <nav class="navbar">
        <div class="brand-text">
            <a class="img" href="#top"><img src="./images/ambatugymwhite.png" alt=""></a>
            <h2>AmbatuGYM</h2>
        </div>
        <ul class="navbar-item">
            <li class="nav-list">
                <a class="nav-link" href="#dashboard">Dashboard</a>
            </li>
            <li class="nav-list">
                <a class="nav-link" href="exercise.php">Exercises</a>
            </li>
            <li class="nav-list">
                <a class="nav-link" href="community.php">Community</a>
            </li>
            <li class="nav-list">
                <img src="./user_pp/<?= $photo ?> " onclick="toggleDropdown()" class="profile-pic">
                <div id="dropdown" class="dropdown-content">
                    <a href="./profile.php">Profil</a>
                    <a href="./logic/logout.php" id="logout">Logout</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggle" onclick="openNav()">☰</button>
        <div id="mySidenav" class="sidenav" style="margin-top: 60px;">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#">Dashboard</a>
            <a href="exercise.php">Exercises</a>
            <a href="community.php">Community</a>
            <a href="./logic/logout.php" style="color: red;" onclick="logout()">Logout</a>
        </div>
    </nav>

    <main>
        <div class="left-section">
            <div class="welcome" id="dashboard">
                <h1 id="top">Welcome, <span><?= $username ?></span>!</h1>
            </div>
            <div class="daily-training card">
                <h2>Daily Training</h2>
                <div class="trainings">

                    <button class="training-card" onclick="openPopup0()">
                        <div class="training-image">
                            <img src="./latihan/<?= $exercise[0]['video_url']; ?>">
                        </div>
                        <h3><?= $exercise[0]['exercise_name']; ?></h3>
                    </button>

                    <button class="training-card" onclick="openPopup1()">
                        <div class="training-image">
                            <img src="./latihan/<?= $exercise[1]['video_url']; ?>" >
                        </div>
                        <h3><?= $exercise[1]['exercise_name']; ?></h3>
                    </button>

                    <button class="training-card" onclick="openPopup2()">
                        <div class="training-image">
                            <img src="./latihan/<?= $exercise[2]['video_url']; ?>">
                        </div>
                        <h3><?= $exercise[2]['exercise_name']; ?></h3>      
                    </button>
                </div>
            </div> 

        <!-- Modal untuk pop up -->
            <div class="popup" id="popup0">
                <div class="popup-content">
                    <span class="close" onclick="closePopup0()">&times;</span>
                    <h2><?= $exercise[0]['exercise_name']; ?></h2>
                    <img src="./latihan/<?= $exercise[0]['video_url']; ?>">
                    <p><?= $exercise[0]['description']; ?></p>
                    <div class="details">
                        <div class="detail">
                            <h4>Repetition &ensp;&ensp;&ensp;&ensp;&ensp; : <?= $exercise[0]["repetisi"]; ?></h4>
                            <h4>Calories Burned : <?= $exercise[0]["kalori_terbakar"]; ?><span> Cal</span></h4>
                        </div>
                        <a href="./logic/exercise_done.php?id=<?= $exercise[0]['exercise_id']; ?>&calorie=<?= $exercise[0]['kalori_terbakar']; ?>">
                            <button>Done</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="popup" id="popup1">
                <div class="popup-content">
                    <span class="close" onclick="closePopup1()">&times;</span>
                    <h2><?= $exercise[1]['exercise_name']; ?></h2>
                    <img src="./latihan/<?= $exercise[1]['video_url']; ?>" >
                    <p><?= $exercise[1]['description']; ?></p>
                    <div class="details">
                        <div class="detail">
                            <h4>Repetition &ensp;&ensp;&ensp;&ensp;&ensp; : <?= $exercise[1]["repetisi"]; ?></h4>
                            <h4>Calories Burned : <?= $exercise[1]["kalori_terbakar"]; ?><span> Cal</span></h4>
                        </div>
                        <a href="./logic/exercise_done.php?id=<?= $exercise[1]['exercise_id']; ?>&calorie=<?= $exercise[1]['kalori_terbakar']; ?>">
                            <button>Done</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="popup" id="popup2">
                <div class="popup-content">
                    <span class="close" onclick="closePopup2()">&times;</span>
                    <h2><?= $exercise[2]['exercise_name']; ?></h2>
                    <img src="./latihan/<?= $exercise[2]['video_url']; ?>" >
                    <p><?= $exercise[2]['description']; ?></p>
                    <div class="details">
                        <div class="detail">
                            <h4>Repetition &ensp;&ensp;&ensp;&ensp;&ensp; : <?= $exercise[2]["repetisi"]; ?></h4>
                            <h4>Calories Burned : <?= $exercise[2]["kalori_terbakar"]; ?><span> Cal</span></h4>
                        </div>
                        <a href="./logic/exercise_done.php?id=<?= $exercise[2]['exercise_id']; ?>&calorie=<?= $exercise[2]['kalori_terbakar']; ?>">
                            <button>Done</button>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="community">
                <div class="community-card">
                    <h2 style="margin-bottom: 20px;">Community</h2>

                    <?php foreach($comment as $komen) : ?>
                    <div class="comment-card">
                        <div class="left-comment">
                            <img src="./user_pp/<?= $komen["foto"]; ?>" alt="">
                        </div>
                        <div class="right-comment">
                            <div class="container-info">
                                <p><?= $komen["username"]; ?></p>
                                <p><?= $komen["tanggal"]; ?></p>
                            </div>
                            <p class="content"> <?= $komen["komentar"]; ?> </p>
                        </div>
                    </div>
                    <?php endforeach;  ?>
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
                                <h2><?= $complete; ?></h2>
                            </div>
                        </div>

                        <div class="stat-card">
                            <h3>Days Streak</h3>
                            <div class="value">
                                <img src="./images/days.png" height="50px" width="50px" alt="exercise completed">
                                <h2><?= $daystreak; ?></h2>
                            </div>
                        </div>

                        <div class="stat-card">
                            <h3>Calories Burned</h3>
                            <div class="value">
                                <img src="./images/icons8-fire-100.png" height="50px" width="50px" alt="exercise completed">
                                <h2><?= $calorie; ?> <span>Cal</span></h2>
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

        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("mySidenav").style.display = "block";
            
        }

        function closeNav() {
            document.getElementById("mySidenav").style.display = "none";
        }

        //function untuk pop up daily training
        function openPopup0() {
            document.getElementById('popup0').style.display = 'flex';
        }

        function openPopup1() {
            document.getElementById('popup1').style.display = 'flex';
        }

        function openPopup2() {
            document.getElementById('popup2').style.display = 'flex';
        }

        function closePopup0() {
            document.getElementById('popup0').style.display = 'none';
        }

        function closePopup1() {
            document.getElementById('popup1').style.display = 'none';
        }

        function closePopup2() {
            document.getElementById('popup2').style.display = 'none';
        }


    </script>

</body>

</html>

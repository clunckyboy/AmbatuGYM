<?php
    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    require "./database/config.php";

    $query = "SELECT exercise_id AS id,
                    exercise_name AS name,
                    description AS deskripsi,
                    repetisi AS repetisi,
                    kalori_terbakar AS kalori,
                    video_url AS video
                 FROM exercises 
                 ORDER BY exercise_id";
    
    $result = $db->query($query);
    
    $rows = [];
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }


?>    


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuGYM - Exercise</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <link rel="stylesheet" href="./styles/exercise.css">
</head>
<body>

<nav class="navbar">
    <div class="brand-text">
        <a class="img" href="#top"><img src="./images/ambatugymwhite.png" alt=""></a>
        <h2>AmbatuGYM</h2>
    </div>
    <ul class="navbar-item">
        <li class="nav-list">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-list">
            <a class="nav-link" href="#">Exercises</a>
        </li>
        <li class="nav-list">
            <a class="nav-link" href="community.php">Community</a>
        </li>
            <li class="nav-list">
            <img src="./user_pp/<?= $_SESSION['user']['profile_photo']; ?> " alt="Profile" onclick="toggleDropdown()" class="profile-pic">
            <div id="dropdown" class="dropdown-content">
                <a href="./profile.php">Profil</a>
                <a href="./logic/logout.php" id="logout">Logout</a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggle" onclick="openNav()">☰</button>
    <div id="mySidenav" class="sidenav" style="margin-top: 60px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="#">Exercises</a>
        <a href="community.php">Community</a>
        <a href="./logic/logout.php" style="color: red;" onclick="logout()">Logout</a>
    </div>
</nav>


<!-- Container Utama Halaman Exercise -->
<div class="exercise-page">
    <!-- Sidebar untuk Daftar Latihan -->
    <div class="exercise-sidebar">
        <div class="exercise-category">
            <h2 style="margin: 0;">Exercises</h2>
            <button class="category-button">Goals</button>
            <div class="category-options">
                <p data-category="kategori-1">Lose Weight</p>
                <p data-category="kategori-2">Build Muscle</p>
                <p data-category="kategori-3">Maintain Stamina</p>
            </div>
        </div>

        <div class="exercise-list">
            <ul id="exercise-list">
                <li data-exercise="burpee">Burpee</li>
                <li data-exercise="jumping-jack">Jumping Jack</li>
                <li data-exercise="montain-climber">Montain Climber</li>
                <li data-exercise="high-knees">High Knees</li>
                <li data-exercise="skater-jump">Skater Hop</li>
                <li data-exercise="bodyweight-squat">Bodyweight Squat</li>
                <li data-exercise="plank-to-pushup">Plank to Push-Up</li>

            </ul>
        </div>
    </div>

    <!-- Bagian Detail Latihan -->
    <div class="exercise-details">
        <div id="burpee" class="exercise-content" style="display: none;">
            <h2> <?= $rows[0]["name"]; ?> </h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/burpee.gif" alt="Burpee exercise GIF" width="100%">
            </div>
            <p><?= $rows[0]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[0]["kalori"]; ?> Cal</span>
                <span><?= $rows[0]["repetisi"]; ?></span>
            </div>
        </div>
            
        <div id="jumping-jack" class="exercise-content" style="display:none;">
            <h2><?= $rows[1]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/jumpingjack.gif" alt="Jumping Jack exercise GIF" width="100%">
            </div>
            <p><?= $rows[1]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[1]["kalori"]; ?> Cal</span>
                <span><?= $rows[1]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="mountain-climber" class="exercise-content" style="display:none;">
            <h2><?= $rows[2]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/mountainclimber.gif" alt="Montain Climber exercise GIF" width="100%">
            </div>
            <p><?= $rows[2]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[2]["kalori"]; ?> Cal</span>
                <span><?= $rows[2]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="high-knees" class="exercise-content" style="display: none;">
            <h2><?= $rows[3]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/highknee.gif" alt="High Knees exercise GIF" width="100%">
            </div>
            <p><?= $rows[3]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[3]["kalori"]; ?> Cal</span>
                <span><?= $rows[3]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="skater-hop" class="exercise-content" style="display: none;">
            <h2><?= $rows[4]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/skaterhop.gif" alt="Skater Jump exercise GIF" width="100%">
            </div>
            <p><?= $rows[4]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[4]["kalori"]; ?> Cal</span>
                <span><?= $rows[4]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="bodyweight-squat" class="exercise-content" style="display: none;">
            <h2><?= $rows[5]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/bodyweightsquat.gif" alt="Bodyweight Squat exercise GIF" width="100%">
            </div>
            <p><?= $rows[5]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[5]["kalori"]; ?> Cal</span>
                <span><?= $rows[5]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="plank-to-pushup" class="exercise-content" style="display: none;">
            <h2><?= $rows[6]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/plankpushup.gif" alt="Plank to Push-Up exercise GIF" width="100%">
            </div>
            <p><?= $rows[6]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[6]["kalori"]; ?> Cal</span>
                <span><?= $rows[6]["repetisi"]; ?></span>
            </div>
        </div>
        

        <!-- Konten latihan untuk kategori-2 -->

        <div id="push-up" class="exercise-content" style="display: none;">
            <h2><?= $rows[7]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/pushup.gif" alt="Push-Up exercise GIF" width="100%">
            </div>
            <p><?= $rows[7]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[7]["kalori"]; ?> Cal</span>
                <span><?= $rows[7]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="pull-up" class="exercise-content" style="display: none;">
            <h2><?= $rows[8]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/pullup.gif" alt="Pull-Up exercise GIF" width="100%">
            </div>
            <p><?= $rows[8]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[8]["kalori"]; ?> Cal</span>
                <span><?= $rows[8]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="bench-press" class="exercise-content" style="display: none;">
            <h2><?= $rows[9]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/benchpress.gif" alt="Bench Press exercise GIF" width="100%">
            </div>
            <p><?= $rows[9]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[9]["kalori"]; ?> Cal</span>
                <span><?= $rows[9]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="bicep-curl" class="exercise-content" style="display: none;">
            <h2><?= $rows[10]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/bicepcurl.gif" alt="Bicep Curl exercise GIF" width="100%">
            </div>
            <p><?= $rows[10]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[10]["kalori"]; ?> Cal</span>
                <span><?= $rows[10]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="dumbbell-shoulder-press" class="exercise-content" style="display: none;">
            <h2><?= $rows[11]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/dumbellshoulderpress.gif" alt="Dumbbell Shoulder Press exercise GIF" width="100%">
            </div>
            <p><?= $rows[11]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[11]["kalori"]; ?> Cal</span>
                <span><?= $rows[11]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="deadlift" class="exercise-content" style="display: none;">
            <h2><?= $rows[12]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/deadlift.gif" width="100%">
            </div>
            <p><?= $rows[12]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[12]["kalori"]; ?> Cal</span>
                <span><?= $rows[12]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="lunges" class="exercise-content" style="display: none;">
            <h2><?= $rows[13]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/lunges.gif" alt="Bodyweight Lunges exercise GIF" width="100%">
            </div>
            <p><?= $rows[13]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[13]["kalori"]; ?> Cal</span>
                <span><?= $rows[13]["repetisi"]; ?></span>
            </div>
        </div>
        


        
        <!-- Konten latihan untuk kategori-3 -->

        <div id="jog-in-place" class="exercise-content" style="display: none;">
            <h2><?= $rows[14]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/joginplace.gif" alt="Jogging di Tempat exercise GIF" width="100%">
            </div>
            <p><?= $rows[14]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[14]["kalori"]; ?> Cal</span>
                <span><?= $rows[14]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="jump-rope" class="exercise-content" style="display: none;">
            <h2><?= $rows[15]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/jumprope.gif" alt="Jump Rope exercise GIF" width="100%">
            </div>
            <p><?= $rows[15]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[15]["kalori"]; ?> Cal</span>
                <span><?= $rows[15]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="butt-kick" class="exercise-content" style="display: none;">
            <h2><?= $rows[16]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/buttkick.gif" alt="Bodyweight Lunges exercise GIF" width="100%">
            </div>
            <p><?= $rows[16]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[16]["kalori"]; ?> Cal</span>
                <span><?= $rows[16]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="bear-crawl" class="exercise-content" style="display: none;">
            <h2><?= $rows[17]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/bearcrawl.gif" alt="Bear Crawl exercise GIF" width="100%">
            </div>
            <p><?= $rows[17]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[17]["kalori"]; ?> Cal</span>
                <span><?= $rows[17]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="russian-twists" class="exercise-content" style="display: none;">
            <h2><?= $rows[18]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/russiantwist.gif" alt="Russian Twists exercise GIF" width="100%">
            </div>
            <p><?= $rows[18]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[18]["kalori"]; ?> Cal</span>
                <span><?= $rows[18]["repetisi"]; ?></span>
            </div>
        </div>

        <div id="step-up" class="exercise-content" style="display: none;">
            <h2><?= $rows[19]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/stepup.gif" alt="Russian Twists exercise GIF" width="100%">
            </div>
            <p><?= $rows[19]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[19]["kalori"]; ?> Cal</span>
                <span><?= $rows[19]["repetisi"]; ?></span>
            </div>
        </div>
        
        <div id="plankhold" class="exercise-content" style="display: none;">
            <h2><?= $rows[20]["name"]; ?></h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/plankhold.gif" alt="Plank Hold exercise GIF" width="100%">
            </div>
            <p><?= $rows[20]["deskripsi"]; ?></p>
            <div class="exercise-info">
                <span><?= $rows[20]["kalori"]; ?> Cal</span>
                <span><?= $rows[20]["repetisi"]; ?></span>
            </div>
        </div>
        
        


        <!-- Tambahkan detail untuk latihan lain jika perlu -->
    </div>

</div>
    <script src="./scripts/exercise.js"></script>
</body>
</html>
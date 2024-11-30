<?php
    session_start();

    $photo = $_SESSION["user"]["profile_photo"];
    
    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }


    include "./database/config.php";

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmbatuGYM - Exercise</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/exercise.css">
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


<!-- Container Utama Halaman Exercise -->
<div class="exercise-page">
    <!-- Sidebar untuk Daftar Latihan -->
    <div class="exercise-sidebar">
        <div class="exercise-category">
            <h2 style="margin: 0;">Exercises</h2>
            <button class="category-button">Pilih Jenis Latihan</button>
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
                <li data-exercise="skater-jump">Skater Jump</li>
                <li data-exercise="bodyweight-squat">Bodyweight Squat</li>
                <li data-exercise="plank-to-pushup">Plank to Push-Up</li>
            </ul>
        </div>
    </div>

    <!-- Bagian Detail Latihan -->
    <div class="exercise-details">
        <div id="burpee" class="exercise-content" style="display: none;">
            <h2>Burpee</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/burpee.gif" alt="Burpee exercise GIF" width="100%">
            </div>
            <p>Burpee adalah latihan olahraga yang melibatkan hampir seluruh bagian tubuh dan dilakukan secara berulang.</p>
            <div class="exercise-info">
                <span>150 cal</span>
                <span>20 x 3 Reps</span>
            </div>
        </div>
            
        <div id="jumping-jack" class="exercise-content" style="display:none;">
            <h2>Jumping Jack</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/jumpingjack.gif" alt="Jumping Jack exercise GIF" width="100%">
            </div>
            <p>Jumping jack adalah latihan kardio yang dilakukan dengan cara melompat sambil mengangkat tangan ke atas dan membuka kaki secara bersamaan.</p>
            <div class="exercise-info">
                <span>90 cal</span>
                <span>50 x 3 Reps</span>
            </div>
        </div>

        <div id="mountain-climber" class="exercise-content" style="display:none;">
            <h2>Mountain Climber</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/mountainclimber.gif" alt="Montain Climber exercise GIF" width="100%">
            </div>
            <p>Mountain climber adalah gerakan senam yang melatih seluruh tubuh, terutama bagian atas dan bawah, dengan gerakan naik-turun seperti sedang mendaki gunung.</p>
            <div class="exercise-info">
                <span>135 cal</span>
                <span>20 x 3 Reps</span>
            </div>
        </div>

        <div id="high-knees" class="exercise-content" style="display: none;">
            <h2>High Knees</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/highknee.gif" alt="High Knees exercise GIF" width="100%">
            </div>
            <p>High knees adalah latihan kardio yang dilakukan dengan kecepatan tinggi untuk memperkuat otot kaki, meningkatkan detak jantung, dan meningkatkan fleksibilitas.</p>
            <div class="exercise-info">
                <span>105 cal</span>
                <span>50 x 3 Reps</span>
            </div>
        </div>

        <div id="skater-jump" class="exercise-content" style="display: none;">
            <h2>Skater Jumps</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/skaterhop.gif" alt="Skater Jump exercise GIF" width="100%">
            </div>
            <p>Skater jumps adalah latihan kardio yang melibatkan lompatan untuk menggeser berat badan dari satu sisi ke sisi lain, seperti saat bermain skate.</p>
            <div class="exercise-info">
                <span>120 cal</span>
                <span>30 x 3 Reps</span>
            </div>
        </div>

        <div id="bodyweight-squat" class="exercise-content" style="display: none;">
            <h2>Bodyweight Squat</h2>
            <div class="video-container">
                <img src="./latihan/turun_berat/bodyweightsquat.gif" alt="Bodyweight Squat exercise GIF" width="100%">
            </div>
            <p>Bodyweight squat adalah latihan jongkok yang menggunakan beban tubuh untuk menguatkan bagian bawah tubuh.</p>
            <div class="exercise-info">
                <span>90 cal</span>
                <span>25 x 3 Reps</span>
            </div>
        </div>

        <!-- Konten latihan untuk kategori-2 -->

        <div id="push-up" class="exercise-content" style="display: none;">
            <h2>Push-Up</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/pushup.gif" alt="Push-Up exercise GIF" width="100%">
            </div>
            <p>Latihan push-up dilakukan dengan menekan tubuh ke atas menggunakan lengan dan bahu.</p>
            <div class="exercise-info">
                <span>75 kalori</span>
                <span>15 x 3 Reps</span>
            </div>
        </div>
        
        <div id="pull-up" class="exercise-content" style="display: none;">
            <h2>Pull-Up</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/pullup.gif" alt="Pull-Up exercise GIF" width="100%">
            </div>
            <p>Gerakan ini dilakukan dengan menggantung pada palang, lalu menarik tubuh ke atas hingga dagu melewati palang.</p>
            <div class="exercise-info">
                <span>60 kalori</span>
                <span>10 x 3 Reps</span>
            </div>
        </div>
        
        <div id="bench-press" class="exercise-content" style="display: none;">
            <h2>Bench Press</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/benchpress.gif" alt="Bench Press exercise GIF" width="100%">
            </div>
            <p>Latihan bench press dilakukan dengan berbaring di bangku dan menekan beban ke atas dan ke bawah.</p>
            <div class="exercise-info">
                <span>105 kalori</span>
                <span>12 x 3 Reps</span>
            </div>
        </div>
        
        <div id="bicep-curl" class="exercise-content" style="display: none;">
            <h2>Bicep Curl</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/bicepcurl.gif" alt="Bicep Curl exercise GIF" width="100%">
            </div>
            <p>Latihan ini berfokus pada penguatan otot bicep dengan mengangkat beban di kedua tangan.</p>
            <div class="exercise-info">
                <span>45 kalori</span>
                <span>12 x 3 Reps</span>
            </div>
        </div>
        
        <div id="dumbbell-shoulder-press" class="exercise-content" style="display: none;">
            <h2>Dumbbell Shoulder Press</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/dumbellshoulderpress.gif" alt="Dumbbell Shoulder Press exercise GIF" width="100%">
            </div>
            <p>Latihan ini dilakukan dengan menekan dumbbell ke atas untuk melatih bahu dan kekuatan tubuh bagian atas.</p>
            <div class="exercise-info">
                <span>60 kalori</span>
                <span>12 x 3 Reps</span>
            </div>
        </div>
        
        <div id="deadlift" class="exercise-content" style="display: none;">
            <h2>Deadlift</h2>
            <div class="video-container">
                <img src="./latihan/besar_otot/deadlift.gif" alt="Deadlift exercise GIF" width="100%">
            </div>
            <p>Latihan deadlift dilakukan dengan mengangkat beban dari lantai hingga ke posisi berdiri tegak.</p>
            <div class="exercise-info">
                <span>120 kalori</span>
                <span>10 x 3 Reps</span>
            </div>
        </div>
        
        <!-- Konten latihan untuk kategori-3 -->

        <div id="jogging-di-tempat" class="exercise-content" style="display: none;">
            <h2>Jogging di Tempat</h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/joginplace.gif" alt="Jogging di Tempat exercise GIF" width="100%">
            </div>
            <p>Latihan ini dilakukan dengan berlari di tempat untuk meningkatkan kebugaran kardiovaskular.</p>
            <div class="exercise-info">
                <span>150 kalori</span>
                <span>5 menit x 3</span>
            </div>
        </div>
        
        <div id="jump-rope" class="exercise-content" style="display: none;">
            <h2>Jump Rope</h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/jumprope.gif" alt="Jump Rope exercise GIF" width="100%">
            </div>
            <p>Latihan lompat tali untuk membakar kalori dan melatih daya tahan kardiovaskular.</p>
            <div class="exercise-info">
                <span>135 kalori</span>
                <span>1 menit x 3</span>
            </div>
        </div>
        
        <div id="bodyweight-lunges" class="exercise-content" style="display: none;">
            <h2>Bodyweight Lunges</h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/buttkick.gif" alt="Bodyweight Lunges exercise GIF" width="100%">
            </div>
            <p>Latihan ini membantu menguatkan otot paha dan glute dengan melakukan lunge tanpa beban.</p>
            <div class="exercise-info">
                <span>60 kalori</span>
                <span>20 x 3</span>
            </div>
        </div>
        
        <div id="bear-crawl" class="exercise-content" style="display: none;">
            <h2>Bear Crawl</h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/bearcrawl.gif" alt="Bear Crawl exercise GIF" width="100%">
            </div>
            <p>Latihan ini melibatkan merangkak dengan tangan dan kaki untuk melatih kekuatan dan stabilitas tubuh.</p>
            <div class="exercise-info">
                <span>90 kalori</span>
                <span>30 detik x 3</span>
            </div>
        </div>
        
        <div id="russian-twists" class="exercise-content" style="display: none;">
            <h2>Russian Twists</h2>
            <div class="video-container">
                <img src="./latihan/pelihara_stamina/russiantwist.gif" alt="Russian Twists exercise GIF" width="100%">
            </div>
            <p>Latihan ini berfokus pada penguatan otot perut dengan gerakan memutar ke kanan dan kiri.</p>
            <div class="exercise-info">
                <span>45 kalori</span>
                <span>25 x 3</span>
            </div>
        </div>
        
        <div id="step-up" class="exercise-content" style="display: none;">
            <h2>Step-Up (dengan bench)</h2>
            <div class="./latihan/pelihara_stamina/video-container">
                <img src="./latihan/pelihara_stamina/stepup.gif" alt="Step-Up exercise GIF" width="100%">
            </div>
            <p>Latihan ini dilakukan dengan melangkah naik ke bench atau bangku untuk melatih kekuatan kaki.</p>
            <div class="exercise-info">
                <span>75 kalori</span>
                <span>20 x 3</span>
            </div>
        </div>
        


        <!-- Tambahkan detail untuk latihan lain jika perlu -->
    </div>

</div>

    <script src="./scripts/exercise.js"></script>
</body>
</html>

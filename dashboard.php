<?php
    include "./database/config.php";
    session_start();

  if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: index.php");
  }

  $data = [];
    $url = [];

$result = $db->query("SELECT video_url FROM exercises, users WHERE users.goal = exercises.goal ORDER BY RAND() LIMIT 3");

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
    <link rel="stylesheet" href="./dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar">
        <a class="img" href="#"><img src="./images/ambatugymwhite.png" alt=""></a>
        <div class="brand-text">
            <h2>AmbatuGYM</h2>
            <p>Fitness and Health Tracker</p>
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
                    <button onclick="toggleDropdown()">
                        <img src="./images/profilepics/edwin.jpg" alt="Profile">
                    </button>
                    <div id="dropdown" class="dropdown-content">
                        <a href="profile.html">Profil</a>
                        <button>Logout</button>     
                    </div>
            </li>
        </ul>

    </nav>

    <main>
        <div class="left-section">
                <div class="welcome" id="dashboard">
                    <h1>Welcome, <span><?=$_SESSION['username']?></span>!</h1>
                </div>
                <div class="daily-training card">
                    <h2>Daily Training</h2>
                    <div class="trainings">
                        <div class="training-card">
                            <div class="training-image">
                                <img src="./latihan/<?=$url[0]?>">
                            </div>
                            <div class="check-section">
                                <h3>nama latihan</h3>
                                <input type="checkbox" class="check-box">
                            </div>
                        </div>

                        <div class="training-card">
                            <div class="training-image">
                                <img src="./latihan/<?=$url[1]?>" alt="">
                            </div>
                            <div class="check-section">
                                <h3>nama latihan</h3>
                                <input type="checkbox" class="check-box">
                            </div>
                        </div>

                        <div class="training-card">
                            <div class="training-image">
                                <img src="./latihan/<?=$url[2]?>" alt="">
                            </div>
                            <div class="check-section">
                                <h3>nama latihan</h3>
                                <input type="checkbox" class="check-box">
                            </div>
                        </div>
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
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto reprehenderit asperiores similique ipsam corrupti nihil quibusdam dolore iusto error totam? Nesciunt accusantium impedit amet eaque dolorem perferendis consectetur, repudiandae sapiente est omnis eveniet debitis dolorum quas asperiores beatae animi pariatur voluptates rem magnam vitae doloribus architecto mollitia non odio. Magni.</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda recusandae non autem, 
                                        eum similique consequatur sunt repellat nesciunt tempore quas? Reprehenderit dolore culpa quis aliquid 
                                        deserunt minima nulla, numquam, odio ut voluptatum repudiandae minus doloremque, magni esse doloribus. 
                                        Consequatur, nemo, pariatur inventore assumenda nesciunt, est facilis ex ipsam accusantium dignissimos
                                        commodi itaque eligendi reprehenderit sequi sit facere vel voluptate vero officiis voluptas labore. 
                                        consequatur quisquam doloribus dolore totam cupiditate adipisci vero, sequi dignissimos voluptates voluptatem
                                        eligendi quaerat voluptatibus laboriosam beatae quas minus quia aliquid obcaecati dolorem maxime, nostrum odio
                                        magnam. Aperiam labore soluta vitae impedit debitis exercitationem nemo suscipit.
                                    </p>
                                </div>
                            </div>

                            <div class="comment-card">
                                <div class="left-comment">
                                    <img src="./images/profilepics/edwin.jpg" alt="">
                                </div>
                                <div class="right-comment">
                                    <p>username</p>
                                    <p class="content">Very nice website, looking forward to using it</p>
                                </div>
                            </div>


                        </div>
                </div>

            </div>
        </div>

        <div class="right-section">
            <div class="statistic">    
                <div class="statistic-card">
                <h2 style="padding-left:20px;">Your Statistic</h2>
                    <div class="statistic-diagram">
                    
                    </div>

                    <div class="mini-stat">
                        <div class="stat-card">
                            <div class="value">
                                <img src="./images/check.png" height="50px" width="50px" alt="exercise completed">
                                <h2>5</h2>
                            </div>
                            <h3>Exercise Completed</h3>
                        </div>

                        <div class="stat-card">
                            <div class="value">
                                <img src="./images/days.png" height="50px" width="50px" alt="exercise completed">
                                <h2>5</h2>
                            </div>
                            <h3>Days Streak</h3>
                        </div>

                        <div class="stat-card">
                            <div class="value">
                                <img src="./images/icons8-fire-100.png" height="50px" width="50px" alt="exercise completed">
                                <h2>125 <span>cal</span></h2>
                            </div>
                            <h3>Calories Burned</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- <script>
    function toggleDropdown() {
        document.getElementById("dropdown").classList.toggle("show");
    }

    // Menutup dropdown jika klik di luar area
    window.onclick = function(event) {
        if (!event.target.closest('.nav-list')) {
            var dropdown = document.getElementById("dropdown");
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
    </script> -->

</body>

</html>

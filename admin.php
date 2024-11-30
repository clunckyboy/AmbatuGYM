<?php
session_start();

if(!isset($_SESSION["admin_login"])){
    header('location: login.php');
    exit;
}

require "database/config.php";

function query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
 

//pagination
$result = mysqli_query($db, "SELECT * FROM users");
$jumlahData = count(query("SELECT * FROM users"));
$jumlahPage = ceil($jumlahData / 5);
$halamanAktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
$awalData = (5 * $halamanAktif) - 5;

// jika halaman aktif =

$data = query("SELECT * FROM users LIMIT $awalData, 5"); //limit 0, 5 : dimulai dari indeks ke-0, sebanyak 5 data


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/ambatugym_icon.png">
    <title>Halaman Admin</title>
    <style>
        body{
            font-family: "Lexend", sans-serif;        
        }

        *{
            margin: 0;
            padding: 0;
        }

        .header{
            display: flex;
            margin-bottom : 10px;
            justify-content: space-between;
        }

        .head{
            display: flex;
        }

        .kanan{
            margin-top: 35px;
            margin-right: 30px;
            /* text-decoration: none; */
        }

        .kanan a{
            text-decoration: none;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            color: black;
            border: 3px solid orange;
            transition: 0.15s;
        }

        .kanan a:hover{
            background-color: orange;
        }

        img{
            margin: 10px;
        }

        h1{
            margin-top: 25px;
            align-items: center;
        }

        main{
            margin: 10px;
            margin-bottom: 30px;
        }

        table{
            margin: auto;
            margin-top: 0;
        }

        th, td{
            padding: 0 7px;
            text-align: center;
        }

        td{
            font-size: small;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="head"> 
            <img src="./images/ambatugym_icon.png" alt="" width="70px">
            <h1>Halaman Admin AmbatuGYM</h1>
        </div>
        <div class="kanan">
            <a href="./logic/logout.php" class="login">Kembali ke halaman login</a>
        </div>
    </div>
    
    <main>        
        
        <table border="1" cellspacing="0">

            <tr>
                <th>No</th>
                <th style="width: 150px;">Aksi</th>
                <th style="width: 150px;">Gambar</th>
                <th style="width: 300px;">Username</th>
                <th style="width: 300px;">Email</th>
                <th style="width: 150px;">Goal</th>
            </tr>
            
            <?php $i = 1; ?>
            <?php foreach($data as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <!-- <a href="" style="color: blue;">Ubah</a> | -->
                    <a href="./logic/hapus.php?id=<?=$row["user_id"];?>" onclick="return confirm('Yakin untuk menghapus data ini ?')" style="color: red;">Hapus</a>          
                </td>
                <td><img src="./user_pp/<?= $row["profile_photo"]; ?>" width="60px"></td>
                <td><?= $row["username"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["goal"]; ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach;  ?>
        
        </table>
        <br>
        <!-- Navigasi -->
        <div style="margin-left: 50px; font-size:large;">
            <?php if( $halamanAktif > 1 ) : ?>
                <a href="?hal=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">&laquo</a>
            <?php endif; ?>  

            <?php for( $i = 1; $i <= $jumlahPage; $i++ ): ?>
                <?php if($i == $halamanAktif) : ?>
                    <a href="?hal=<?= $i ?>" style="font-weight: bold; text-decoration: none; color: blue;"> <?=$i;?> </a>
                <?php else : ?>
                    <a href="?hal=<?= $i ?>" style="text-decoration: none;"> <?=$i;?> </a> 
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if( $halamanAktif < $jumlahPage ) : ?>
                <a href="?hal=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">&raquo</a>
            <?php endif; ?>
        </div>

    </main>



</body>
</html>
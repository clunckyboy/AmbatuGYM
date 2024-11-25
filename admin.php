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

$data = query("SELECT * FROM users");

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
        }

        table{
            margin: auto;
        }

        th, td{
            padding: 7px;
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
    </main>



</body>
</html>

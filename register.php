<?php
    include "./database/config.php";
    session_start();

    $register_message = ""; 
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $full_name = $_POST['full-name'];
        $birthdate = $_POST['birth-date'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $goal = $_POST['goal'];
        $gender = $_POST['gender'];
        $gambar = (function(){
            $namaFile = $_FILES['gambar']['name'];
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];

            $valid_ext = ['jpg', 'jpeg', 'png'];
            $ekstensi_gambar = explode('.', $namaFile);
            $ekstensi_gambar = strtolower(end($ekstensi_gambar));
            
            move_uploaded_file($tmpName, './user_pp/'.$namaFile);
            
            return $namaFile;
            
        }) ();

        // Membuat query tanpa bind_param
        $sql = "INSERT INTO users (users_username, users_password, users_fullname, users_email, users_birthdate, users_weight, users_height, users_gender, goal, users_photo) 
                VALUES ('$username', '$password', '$full_name', '$email', '$birthdate', '$weight', '$height', '$gender', '$goal', '$gambar')";

        if ($db->query($sql) === TRUE) {
            $register_message = "Daftar akun berhasil, silahkan login";
        } else {
            $register_message = "Error: " . $db->error;
        }

        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
    <link rel="icon" type="image/x-icon" href="./images/ambatugymwhite.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <title>AmbatuRegister</title>

    <style>

        html{
            scroll-behavior: smooth;
        }

        body {
            background-color: #FF8000;
            font-family: "Lexend", sans-serif;
            background: linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0.5)),url(./images/bg.jpg);
            color: white;
        }

        .navbar {
            box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.185);
            position: fixed;
            top: 0;
            width: 100%;
            height: 70px;
            background-color: #302019 !important;
        }

        .btn-ambatugym {
            border: 2px solid #954928;
            color: #954928;
            transition: transform 0.1s ease-in-out, background-color 0.1s;
            text-align: center;
        }
        .btn-ambatugym:hover {
            background-color: #954928;
        }
        
        .form-container {
            width: 100%;
            max-width: 300px;
        }

        .form-control::placeholder {
            color: rgb(167, 167, 167);
        }

        .form-control, .form-select {
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.147);
            transform: scale(1.02);
        }

        .container-sm {
            margin-top: 6rem;
            margin-bottom: 6rem;
            max-width: 900px;
            border-radius: 5px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.185);
            background-color: #302019 !important;
        }
        
        .btn-custom {
            width: 120px;
            height: 50px;
            font-size: large;
            background-color: #954928;
            /* color: white; */
            transition: transform 0.1s ease-in-out, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
        }
        .btn-custom:hover {
            background-color: #954928;
            border: 2px solid black;
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.147);
        }
        
        .btn-custom:active {
            background-color: rgb(196, 59, 0);
            transform: scale(0.98);
        }

        .tombol-login{
            text-decoration: none;
            color: #FF8000;
        }

        .tombol-login:hover{
            color: white;
        }

    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <div style="display: flex;">
                <img src="./images/ambatugymwhite.png" alt="ambatugym" width="50" height="50">
                <h2 style="margin: 0; margin-left:10px; padding-top: 5px">AmbatuGYM</h2>
            </div>    
            <a class="tombol-login" href="index.php"><button class="btn btn-ambatugym" type="submit" >Login</button></a>
        </div>
      </nav>

      <div class="container-sm p-4 bg-body-tertiary">
        <div class="mb-3">
            <h1 class="text-center">Buat Akun</h1>
        </div>
        <!-- <div class="mb-4"> -->
        <hr>
        <h4>Informasi Akun</h4>
        <p style="color: green;"><i><?=$register_message?></i></p>
        <form action="" method="POST" id="form" enctype="multipart/form-data" autocomplete="off">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">E-mail</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="cth: JohnAmba69@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input name="username" type="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Harus memiliki huruf, angka, dan karakter spesial! (cth: !@#$%^&*)" aria-describedby="passHelp" required>
                </div>
                <div class="mb-3">
                    <label for="inputPasswordConfirm" class="form-label">Password Confirm</label>
                    <p id="confirmMessage" style="color: red; margin: 0; display: none;">Password tidak sama</p>
                    <input type="password" class="form-control" id="inputPasswordConfirm" required>
                </div>
        
        <hr>
            <h4>Data Diri</h4>

                <div class="mb-3">
                    <label for="foto-profil" style="margin-bottom: 5px;">Masukkann foto profil</label>
                    <br>
                    <input type="file" name="gambar" id="" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="mb-3">
                    <label for="inputFullName" class="form-label">Nama Lengkap</label>
                    <input name="full-name" type="text" class="form-control" id="inputFullName" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="inputGender" class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-select" taria-label="Default select example">
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputDOB" class="form-label">Tanggal Lahir</label>
                    <input name="birth-date" type="date" class="form-control" id="inputDOB" required>
                </div>
                <div class="mb-3">
                    <label for="inputBerat" class="form-label">Berat Badan (KG)</label>
                    <input name="weight" type="number" class="form-control" id="inputBerat" required>
                </div>
                <div class="mb-3">
                    <label for="inputTinggi" class="form-label">Tinggi Badan (CM)</label>
                    <input name="height" type="number" class="form-control" id="inputTinggi" required>
                </div>
                <div class="mb-3">
                    <label for="inputTujuan" class="form-label">Tujuan</label>
                    <select name="goal" class="form-select" aria-label="Default select example">
                        <option value="" disabled selected>Pilih Tujuan</option>
                        <option value="lose-weight">Menurunkan berat badan</option>
                        <option value="build_muscle">Membesarkan otot</option>
                        <option value="maintain">Pelihara stamina</option>
                    </select>
                </div>
                <div class="container text-center mt-4">
                    <button class="btn btn-custom" name="register" type="submit">Daftar</button>
                </div>
        </form>
            
      </div>
    
    <script>
        const password = document.getElementById('inputPassword');
        const confirmPassword = document.getElementById('inputPasswordConfirm');
        const message = document.getElementById('confirmMessage');
        const form = document.getElementById('form');

        function validatePassword(){
            if (password.value === '' || confirmPassword.value === ''){
                message.style.display = 'none';
                return;
            }

            if (password.value !== confirmPassword.value){
                message.style.display = 'block';
                return false;
            }
            else {
                message.style.display = 'none'
                return true;
            }
        }

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword)

        form.addEventListener('submit', function(event) {
            if (!validatePassword()) {
                event.preventDefault();
                alert('Password dan konfirmasi password tidak cocok.');
            }
        });
    </script>
      
</body>
</html>
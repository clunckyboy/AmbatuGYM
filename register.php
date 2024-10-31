<?php

//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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

        // Membuat query tanpa bind_param
        $sql = "INSERT INTO users (users_username, users_password, users_fullname, users_email, users_birthdate, users_weight, users_height, users_gender, goal) 
                VALUES ('$username', '$password', '$full_name', '$email', '$birthdate', '$weight', '$height', '$gender', '$goal')";

        if ($db->query($sql) === TRUE) {
            $register_message = "Daftar akun berhasil, silahkan login";
        } else {
            $register_message = "Error: " . $db->error;
        }

        $db->close();
    }



    // $register_message = ""; 
    
    // if(isset($_POST['register'])){
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $email = $_POST['email'];
    //     $full_name = $_POST['full-name'];
    //     $birthdate = $_POST['birth-date'];
    //     $gender = $_POST['gender'];
    //     $weight = $_POST['weight'];
    //     $height = $_POST['height'];
    //     $goal = $_POST['goal'];

    //     // try{
    //         $sql = "INSERT INTO users (users_username, users_password, users_fullname, users_gender, users_email, users_birthdate, users_weight, users_height, goal)
    //         VALUES ('$username', '$password', '$full_name', '$gender' '$email', '$birthdate', '$weight', '$height', '$goal')";

    //         if($db->query($sql) === TRUE){
    //             $register_message = "Daftar akun berhasil, silahkan login";
    //         } else {
    //             $register_message = "Daftar akun gagal, coba lagi";
    //         }
            // mysqli_sql_exception
        // } catch(Exception $e){
            // $e->getMessage();
            // $register_message = "username sudah digunakan";
        // }
        // $db->close();   
    // }

//     include "./database/config.php";
//     session_start();

//     $register_message = ""; 
    
//     if(isset($_POST['register'])){
//         $username = $_POST['username'];
//         $password = $_POST['password'];
//         $email = $_POST['email'];
//         $full_name = $_POST['full-name'];
//         $birthdate = $_POST['birth-date'];
//         $weight = $_POST['weight'];
//         $height = $_POST['height'];
//         $goal = $_POST['goal'];
//         $gender = $_POST['gender'];

//         try {
//             $stmt = $db->prepare("INSERT INTO users (users_username, users_password, users_fullname, users_email, users_birthdate, users_weight, users_height, users_gender, goal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
//             $stmt->bind_param("sssssiiss", $username, $password, $full_name, $email, $birthdate, $weight, $height, $gender, $goal);

//             if ($stmt->execute()) {
//                 $register_message = "Daftar akun berhasil, silahkan login";
//             } else {
//                 $register_message = "Daftar akun gagal, coba lagi";
//             }
//             $stmt->close();
//         } catch (Exception $e) {
//             $register_message = "Error: " . $e->getMessage();
//         }
//         $db->close();
//     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="./images/ambatugym2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <title>AmbatuRegister</title>

    <style>
        body {
            background-color: #FF8000;
        }

        .navbar {
            box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.185);
            position: fixed;
            top: 0;
            width: 100%;
        }

        .btn-ambatugym {
            border: 2px solid #FF8000;
            color:#FF8000;
            transition: transform 0.1s ease-in-out, background-color 0.1s;
            text-align: center;
        }
        .btn-ambatugym:hover {
            background-color: #FF8000;
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
        }
        
        .btn-custom {
            width: 120px;
            height: 50px;
            font-size: large;
            background-color: #FF8000;
            /* color: white; */
            transition: transform 0.1s ease-in-out, box-shadow 0.15s;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.695);
        }
        .btn-custom:hover {
            background-color: #FF8000;
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
            <img src="./images/ambatugym2.png" alt="ambatugym" width="50" height="50">
            <a class="tombol-login" href="index.html"><button class="btn btn-ambatugym" type="submit" >Login</button></a>
        </div>
      </nav>

      <div class="container-sm p-4 bg-body-tertiary">
        <div class="mb-3">
            <h1 class="text-center">Buat Akun</h1>
        </div>
        <!-- <div class="mb-4"> -->
        <hr>
        <h4>Informasi Akun</h4>
        <form action="register1.php" method="POST">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">E-mail</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="cth: JohnAmba69@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input name="username" type="username" class="form-control" id="inputUsername" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <i> <?= $register_message ?> </i>
                    <label for="inputPassword" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Harus memiliki huruf, angka, dan karakter spesial! (cth: !@#$%^&*)" aria-describedby="passHelp" required>
                </div>
                <div class="mb-3">
                    <label for="inputPasswordConfirm" class="form-label">Password Confirm</label>
                    <input type="password" class="form-control" id="inputPasswordConfirm" required>
                </div>
        
        <hr>
            <h4>Data Diri</h4>
            
                <div class="mb-3">
                    <label for="inputFullName" class="form-label">Nama Lengkap</label>
                    <input name="full-name" type="text" class="form-control" id="inputFullName" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="inputGender" class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-select" taria-label="Default select example">
                        <option selected>Jenis Kelamin</option>
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
                    <label for="inputTujuan" class="form-label">Tujuan (Opsional)</label>
                    <select name="goal" class="form-select" taria-label="Default select example">
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
      


    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>
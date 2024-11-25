<?php
    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    require '../database/config.php';
    $id = $_GET["id"];

    if(mysqli_query($db, "DELETE FROM users WHERE user_id = $id")){
        echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = '../admin.php';
            </script>
        ";       
    }
?>


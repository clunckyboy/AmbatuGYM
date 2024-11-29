<?php

    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        require "../database/config.php";
     
        $id = $_GET["id"];

        $content = htmlspecialchars($_POST["comment"]);
            
        $query = "UPDATE community SET likes_count = likes_count + 1 WHERE post_id = $id";
         
        $db->query($query);

        // if ($db->query($query) === TRUE) {
            
        //     $register_message = "Comment Added !";
        // } else {
        //     $register_message = "Error: " . $db->error;
        // }
    }

    header("location: ../community.php");
        exit;





?>
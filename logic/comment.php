<?php

    session_start();

    if ( !isset($_SESSION["is_login"]) ){
        header("location: login.php");
        exit;
    }
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        require "../database/config.php";
        
        if(isset($_POST["submit"])){
            $id = $_SESSION["user"]["user_id"];
            $content = htmlspecialchars($_POST["comment"]);
            
            $query = "INSERT INTO community (user_id, content) VALUES ($id, '$content')";
            
            if ($db->query($query) === TRUE) {
                
                $register_message = "Comment Added !";
            } else {
                $register_message = "Error: " . $db->error;
            }

            header("location: ../community.php");
            exit;

        }
    }
    

?>
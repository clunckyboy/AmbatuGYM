<?php
  
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database_name = "ambatugym";

  $db = mysqli_connect($hostname, $username, $password, $database_name);

  if($db->connect_error){
    die("error!");
  }


?>
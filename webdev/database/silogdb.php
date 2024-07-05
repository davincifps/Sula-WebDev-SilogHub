<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "silogdb";
    $conn = "";

    $conn = mysqli_connect ($db_server,$db_user,$db_pass,$db_name);

    if($conn){
        echo "YOU ARE CONNECTED!";
    }
    else{
        echo"FAILED TO CONNECT!";
    }
?>

    
<?php


    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "phpwork";

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn) 
    {
        // echo "Connection successfully!";
    }
    else
    {
        die("Connection Failed!".$conn->connect_error) ;
    }



?>
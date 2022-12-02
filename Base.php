<?php
    
   

    $servername = "localhost";
    $database = "RetoBBDD";
    $username = "reto1";
    $password = "reto1";

    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>   